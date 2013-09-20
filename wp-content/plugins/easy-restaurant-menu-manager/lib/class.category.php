<?php
class WPRMM_Category{
 
/*  public $id, $name, $description;*/


  public function __construct($id = 'ALL') { 
    $this->id = '';
    $this->name = 'New';
    $this->active = 1;
    $this->show_description = 1;
    $this->show_title = 1;
    $this->description = '';

    if(is_numeric($id)) $this->load_category($id);
  }


 
  /* @return all categories in the DB */
  public function get_all($menu_id = 'ALL'){
    global $wpdb;
    $where = is_numeric($menu_id)? 'WHERE menu_id="'.$menu_id.'"' : '';

    $categories = $wpdb->get_results('SELECT * FROM '.WPRMM_CATEGORY_DB.' '.$where.' ORDER BY display_order, id');
    return stripslashes_deep($categories);
  }
  


  /* Create category object from ID */
  private function load_category($id){
    global $wpdb;
    $category = $wpdb->get_results('SELECT * FROM '.WPRMM_CATEGORY_DB.' WHERE id="'.$id.'" LIMIT 1', ARRAY_A);
    $category = $category[0];
    if(empty($category)) return '';

    $this->id = $category['id'];
    $this->name = stripslashes($category['name']);
    $this->description = stripslashes($category['description']);
    $this->layout = stripslashes($category['layout']);
    $this->active = stripslashes($category['active']);
    $this->show_title = stripslashes($category['show_title']);
    $this->show_description = stripslashes($category['show_description']);
    $this->display_order = stripslashes($category['display_order']);
    $this->menu_id = stripslashes($category['menu_id']);
  }



  /* Saves category on admin update */
  public function update($category){
    global $wpdb;
    $wpdb->update(WPRMM_CATEGORY_DB, $category, array('id'=>$category['id']));
    echo wprmm_update_message('Category successfully updated.');
  }



  /* Creates category in DB */
  public function create($category){
    global $wpdb;
    $wpdb->insert(WPRMM_CATEGORY_DB, $category);
    return $wpdb->insert_id;
  }

  /* Deletes menu from DB */
  public function destroy($category_id){
    global $wpdb;
    if(empty($category_id)) return '';
    $wpdb->query('DELETE FROM '.WPRMM_CATEGORY_DB.' WHERE id="'.$category_id.'"'); 
  }

}
?>
