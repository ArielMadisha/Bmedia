<?php 

error_reporting(E_ALL);
ini_set('display_errors', 0);
session_start();
 $_SESSION['bmedia'] = true;

 require_once '../../template/php/db.php';
 $valueList=["whatsapp_number","email"];

 if (isset($_GET['master_audio'])){

$query = "SELECT *  FROM songs order by status";
$results = mysqli_query($connection, $query) or die('{"error" : "Error: Failed to count elements!"}' . mysqli_error($connection));


$publishedsongList=[];
while($row = mysqli_fetch_assoc($results)){
    $publishedsongList[]=$row;
}
//total number of published_songs live in the db
$num_published_songs = sizeof($publishedsongList);
$returndata['data']=$publishedsongList;
$returndata['total']=$num_published_songs;
echo json_encode($returndata);
}
//song stats
if (isset($_GET['master_audio_stats'])){
  //initilization

  $publishedsongStats=[];
$publishedsongStats['audio']['Total']=0;
$publishedsongStats['video']['Total']=0;

//songs 
$query = "SELECT count(item_id) as total,status  FROM songs group by status";
$results_songs = mysqli_query($connection, $query) or die('{"error" : "Error: Failed to count elements!"}' . mysqli_error($connection));
//videos
$query_video = "SELECT count(file_id) as total,status  FROM video_files group by status";
$results_videos = mysqli_query($connection, $query_video) or die('{"error" : "Error: Failed to count elements!"}' . mysqli_error($connection));

while($row1 = mysqli_fetch_assoc($results_videos)){
  $video_status=$row1['status'];
  $video_total=$row1['total'];
  $publishedsongStats['video'][$video_status]=$video_total;
  $publishedsongStats['video']['Total'] +=$video_total;
 }


while($row = mysqli_fetch_assoc($results_songs)){
  $song_status=$row['status'];
  $song_total=$row['total'];
  $publishedsongStats['audio'][$song_status]=$song_total;
  $publishedsongStats['audio']['Total'] +=$song_total;
}
echo json_encode($publishedsongStats);

 }

//master video
if (isset($_GET['master_video'])){

  $query = "SELECT *  FROM video_files order by status";
  $results = mysqli_query($connection, $query) or die('{"error" : "Error: Failed to count elements!"}' . mysqli_error($connection));
  
  
  $publishedvideoList=[];
  while($row = mysqli_fetch_assoc($results)){
      $publishedvideoList[]=$row;
  }
  //total number of published_songs live in the db
  $returndataVideo['data']=$publishedvideoList;
  $returndataVideo['total']= sizeof($publishedvideoList);
  echo json_encode($returndataVideo);
  }
  

if (isset($_GET['pagecontrols'])){
  $querypageControls="SELECT pagename,isActive,created_at,value from pagecontrols";
$resultsListpageControls = mysqli_query($connection, $querypageControls);
$isActivePage=[];
$isActivePage["updated_on"]="";
while($pagecontrols_loop = mysqli_fetch_assoc($resultsListpageControls)){
$pagename=($pagecontrols_loop)['pagename'];
$pagestatus=$pagecontrols_loop['isActive'];
$pagevalue=$pagecontrols_loop['value'];
$isActivePage["updated_on"]=$pagecontrols_loop['created_at'];
if(in_array($pagename,$valueList)){ 
 $pagestatus=$pagevalue;
}
if(explode("-",$pagename)[0] !="Footer" ){
  $isActivePage[$pagename]=$pagestatus;
}

}    
echo json_encode($isActivePage);
 }
//update page controls
 if(isset($_POST['Home'])){
 $data=$_POST;
 $now=date("Y-m-d H:i:s");

 
 foreach($data as $pagename=>$status){
   $updateQuerypageControls="UPDATE pagecontrols set isActive='$status' where pagename='$pagename'"; 
   if(in_array($pagename,$valueList)){
    $updateQuerypageControls="UPDATE pagecontrols set value='$status' where pagename='$pagename'"; 
    }
 
 mysqli_query($connection, $updateQuerypageControls);
 }
 echo "Updated Successfully";
 }
//update medias audio
if (isset($_POST['song_name'])){
$mediaUpdateId=$_POST['song_id'];
$mediaUpdateStatus=$_POST['status'];
$mediaUpdateSongName=$_POST['song_name'];
$mediaUpdateLabel=$_POST['label'];
$updateQueryAudio="UPDATE songs set status='$mediaUpdateStatus',song_name='$mediaUpdateSongName',label='$mediaUpdateLabel' where song_id='$mediaUpdateId'"; 
mysqli_query($connection, $updateQueryAudio);
echo '{"error":"Data Saved Successfully"}';
}

//update medias video
if (isset($_POST['video_name'])){
  $videoUpdateId=$_POST['video_id'];
  $videoUpdateStatus=$_POST['status'];
  $videoUpdateSongName=$_POST['video_name'];
  $youtube_embed_link=$_POST['youtube_embed_link'];
  $updateQueryVideo="UPDATE video_files set status='$videoUpdateStatus',video_name='$videoUpdateSongName',youtube_embed_link='$youtube_embed_link' where file_id='$videoUpdateId'"; 
  mysqli_query($connection, $updateQueryVideo);
  echo '{"error":"Data Saved Successfully"}';
  }
  
//delete medias audio
if (isset($_GET['deleteSongId'])){
 $song_id=$_GET['deleteSongId'];
  $updateQueryAudio="UPDATE songs set deleted='1',status='removed' where song_id='$song_id'"; ;
  mysqli_query($connection, $updateQueryAudio);
  echo '{"error":"Data Saved Successfully"}';
  
 }

//delete medias video
if (isset($_GET['deleteVideoId'])){
  $video_id=$_GET['deleteVideoId'];
  $updateQueryVideo="UPDATE video_files set deleted='1',status='removed' where file_id='$video_id'"; ;
   mysqli_query($connection, $updateQueryVideo);
   echo '{"error":"Data Saved Successfully"}';
  }

  function random_strings() 
{ 
  $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
    return substr(str_shuffle($str_result),  
                       0, rand()); 
} 

  // create ad

  if (isset($_POST['ad_title']) && isset($_POST['ad_status'])){ 

    
     $ad_title=$_POST['ad_title'];
     $ad_sub_title=$_POST['ad_sub_title'];
     $ad_status=$_POST['ad_status'];
     $ad_position=$_POST['position'];
     $ad_url=$_POST['ad_url'];
     $id=$_POST['id'];
     $ad_image=$_FILES['image']['tmp_name'];
     $file_ext=explode('.',$_FILES["image"]["name"])[1];
     $target_dir="/admin/image/". random_strings().".".$file_ext;

      $target_file =  $_SERVER['DOCUMENT_ROOT'] .$target_dir;
      move_uploaded_file($ad_image, $target_file);
    
     // $image_location=$target_dir.".".$file_ext;
     $return['error']="";
     if($id  == 0){
     $ad_create_query="INSERT INTO advertisment (title,url,subtitle,image,status,position) VALUES ('$ad_title','$ad_url','$ad_sub_title','$target_dir','$ad_status','$ad_position')";
     } 
     if($id  > 0){
      $ad_create_query="UPDATE advertisment SET title='$ad_title',url='$ad_url',subtitle='$ad_sub_title',image='$target_dir',status='$ad_status',position='$ad_position'  WHERE id='$id'";
     }
     $results = mysqli_query($connection, $ad_create_query);
     if(! $results){
      $return['error']=mysqli_error($connection);
     }
     die(json_encode($return));
      
  }

  // get list of ad
if (isset($_GET['get_ads'])){
  $queryad="SELECT * from advertisment order by position";
  $resultsListpageControls = mysqli_query($connection, $queryad);
  $listAdd=[];
  
  while($i = mysqli_fetch_assoc($resultsListpageControls)){ 
    $listAdd[]=$i;
  }
    echo json_encode($listAdd);
 }
?>
