<?php 

class Search extends \Kirby\Toolkit\Search {

  protected $results;

  public function __construct($params) {

    $query  = get('q');
    $fields = array();

    parent::__construct($query, $fields, $params);

    // search!
    $this->run();

  }

  protected function defaults() {
  
    return array_merge(parent::defaults(), array(
      'in'          => false, 
      'score'       => array(),
      'ignore'      => array(),
      'include'     => array(),
      'searchfield' => 'q',
      'paginate'    => false
    ));

  }

  protected function run() {

    // define the set of pages to search in
    $pages  = ($this->options['in']) ? site()->pages()->find($this->options['in'])->children()->index() : site()->pages()->index();                        
    $fields = $this->fields();

    // build the regular expressions
    $preg = array();

    foreach($this->words() as $word) {
      $preg[] = preg_quote($word);
    }

    if($this->options['words']) {
      $preg = '!\b(' . implode('|', $preg) . ')\b!i';
    } else {
      $preg = '!(' . implode('|', $preg) . ')!i';      
    }

    // go through all pages and search 
    foreach($pages as $page) {

      if($this->options['include'] == 'visible'   && $page->isInvisible()) continue;
      if($this->options['include'] == 'invisible' && $page->isVisible())   continue;

      // get the page's uri
      $uri = $page->uri();
          
      // exclude ignored uris
      if(in_array($uri, $this->options['ignore'])) continue;
      
      // skip pages without content
      if(!$page->content()) continue;

      if(!empty($fields)) {    
        $keys = array_intersect($page->content()->fields(), $this->fields());
      } else {
        $keys = $page->content()->fields();
      }
      
      $found        = array();
      $matchedTotal = 0;
      $score        = 0;
      
      foreach($keys as $field) {
        
        $value      = (string)$page->content()->data($field);
        $fieldScore = a::get($this->options['score'], $field, 1);
        $count      = preg_match_all($preg, $value, $matches);

        $matchedTotal += $count;  

        // apply the score for this field
        $score = $score + ($count * $fieldScore);
        
      }
      
      // add all matched pages to the result set  
      if($matchedTotal) {                      
        $result[$uri] = $page;      
        $result[$uri]->searchHits  = $matchedTotal;
        $result[$uri]->searchScore = $score;
      }
                
    }  
  
    if(empty($result)) return false;
              
    $pages = new Pages($result);
    $pages = $pages->sortBy('searchScore','desc');
  
    // add pagination
    if($this->options['paginate']) $pages = $pages->paginate($this->options['paginate'], array('mode' => 'query'));
    
    $this->results = $pages;

  }

  public function results() {
    return $this->results;
  }

}