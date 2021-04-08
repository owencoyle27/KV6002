<?php
require __DIR__ . './../vendor/autoload.php';
use App\SQLiteConnection;

class database{

  private $pdo;

  function __construct(){
    try {
      //$this->pdo = $pdo;
      $this->pdo = (new SQLiteConnection())->connect();
    } catch (\PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  public function show_user($id){
    $q = "SELECT * from forumusers where usersID = '$id' ";
    $s = $this->pdo->prepare($q);
    $s->execute();
    $r = $s->fetch(PDO::FETCH_ASSOC);
    echo $r['username'];
  }

  public function show_project($id){

    $q1 = "SELECT * FROM posts WHERE postsID = '$id' " ;
    $sql1 = $this->pdo->prepare($q1);
    $sql1->execute();
    $posts = $sql1->fetchAll();
    sleep(2);
    if(count($posts) == 1){

          $update_veiws = "UPDATE posts SET views=views+1 WHERE postsID = '$id' ";
          $sql = $this->pdo->prepare($update_veiws);
          $sql->execute();


      $post = $posts[0];
      $q2 =  "SELECT * FROM forumusers WHERE usersID = '".$post['post_By']."' ";
      $sql2 = $this->pdo->prepare($q2);
      $sql2->execute();
      $user = $sql2->fetch(PDO::FETCH_ASSOC);

      $q3 = "SELECT count(*) FROM comments WHERE postID = '".$post['postsID']."' order by date DESC ";
      $sql3 = $this->pdo->prepare($q3);
      $sql3->execute();
      $comments_count = $sql3->fetchColumn();

      $q4 = "SELECT count(*) FROM response WHERE type=1 and postID = '$id' ";
      $sql4 = $this->pdo->prepare($q4);
      $sql4->execute();
      $upvotes = $sql4->fetchColumn();

      $by = $_SESSION['id'];

      $qu = "SELECT count(*) FROM response WHERE type=1 and postID = '$id' and response_By = '$by' ";
      $sqlu = $this->pdo->prepare($qu);
      $sqlu->execute();
      $upvotes_chk = $sqlu->fetchColumn();

      $q5 = "SELECT count(*) FROM response WHERE type=0 and postID = '$id' ";
      $sql5 = $this->pdo->prepare($q5);
      $sql5->execute();
      $devotes = $sql5->fetchColumn();


      $qd = "SELECT count(*) FROM response WHERE type=0 and postID = '$id'  and response_By = '$by' ";
      $sqld = $this->pdo->prepare($qd);
      $sqld->execute();
      $devotes_chk = $sqld->fetchColumn();

      echo '<div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <div class="card mb-4">
                         <div class="card-header">
                             <div class="media flex-wrap w-100 align-items-center"> <img src="images/default_profile.png" class="d-block ui-w-40 rounded-circle" width="100px" min-height="200px" max-height="200px"  alt="">
                                 <div class="media-body ml-3"> <a href="javascript:void(0)" data-abc="true">'.$user["username"].'</a>
                                     <div class="text-muted small">'.$post["date"].'</div>
                                 </div>
                                 <div class="text-muted small ml-3">

                                     <div><i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle"><strong>'.$post["views"].'</strong></span></div>
                                 </div>
                             </div>
                         </div>
                            <div class="card-body">
                            <h2>'.$post["title"].'</h2> <hr />
                            <p>';
                            echo nl2br($post["description"]) ;

                            echo '
                            </p>
                            </div>


                            <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">




                                                        <div class="px-4 pt-3">


                                                          <button class="btn btn-sm devote" ';

                                                       if(!isset($_SESSION['id'])){
                                                        echo 'disabled';
                                                       }

                                                       if($devotes_chk == 1){
                                                        echo 'style="background-color:#ffcccb" ';
                                                       }

                                                        echo'  >
                                                        <i class="fa fa-arrow-down text-danger"></i>

                                                        <span class="align-middle downcount">'.$devotes.'</span> </button>
                                                        &nbsp;
                                                        &nbsp;


                                                         <button class="btn btn-sm upvote" ';
                                    if(!isset($_SESSION['id'])){
                                                        echo 'disabled';
                                                       }

                                                       if($upvotes_chk == 1){
                                                        echo 'style="background-color:#90ee90" ';
                                                       }


                                                        echo'

                                                         >
                                                        <i class="fa fa-arrow-up text-success"> </i>

                                                        <span class="align-middle upcount">'.$upvotes.'</span></button>

                                                        </div>';


                                  if(isset($_SESSION['id'])){
                                 if($_SESSION['id'] == $user['usersID']   || $_SESSION['accounttype'] == 'Admin' ){


                                  echo '  <div class="px-4 pt-3"> <button type="button" class="deletepost btn btn-danger"><i class="ion ion-md-create"></i>&nbsp; Delete !</button> </div> ';


                                  }}
                                echo '
                                 </div>
                             </div>
                         </div>
                     </div>
                  <b class="ml-1">
           '.$comments_count.'
            Replies</b>
            <p style="float: right;display: inline;">
            <select id="sort" class="form-control form-control-sm" style="width: 150px;">
              <option value="newest">Newest</option>
              <option value="oldest">Oldest</option>
            </select></p>
          <br /><br />';
    } else{
      echo '<script type="text/javascript">
              window.location = "404.php"
            </script>';
    }
  }

  public function show_search_projects($title,$cat,$sdata){
    $query =  "SELECT count(*) FROM posts WHERE category = "."'$cat'"." AND title LIKE '%".$title."%'  ORDER BY views DESC  LIMIT $sdata ";
    $query1 =  "SELECT * FROM posts WHERE category = "."'$cat'"." AND title LIKE '%".$title."%'  ORDER BY views DESC  LIMIT $sdata ";
    $sql1 = $this->pdo->prepare($query1);
    $sql1->execute();
    $sql = $this->pdo->prepare($query);
    $sql->execute();
    if($sql->fetchColumn() == 0){
      echo 0;
    } else{
      while( $row = $sql1->fetch(PDO::FETCH_ASSOC)){
        echo '<div class="card disscusioncards" style="padding: 1px;">
                <div class="card-body">
                  <h5 class="card-title">'.$row['title'].'</h5>
                    <p class="card-text">';
        if (strlen($row['description']) > 150) {
          $maxLength = 149;
          $yourString = substr($row['description'], 0, $maxLength);
          echo $yourString.'...<a href="discussion/'.$row['postsID'].'">Read more</a>';
        }
        else{
          echo $row['description'].'...<a href="discussion.php?id='.$row['postsID'].'">Read more</a>';

        }
        echo '</p>
              <a style="float: right;background-color: #000;" href="discussion.php?id='.$row['postsID'].'" class="btn btn-dark">Read more..</a>
            </div>
          </div>';
      }
      if($sql->fetchColumn() > 4){
        echo '<center><button id="seemore" class="btn btn-dark m-4">See more...</button></center>';
      }
    }
  }

  public function signup($username,$email,$password,$accounttype){
    $q = "SELECT count(*) from forumusers where email = '$email' ";
    $s = $this->pdo->prepare($q);
    $s->execute();
    $n = $s->fetchColumn();
    $date = date("Y-m-d H:i:s");
    if($n == 0){
      $passw = md5($password);
      if($accounttype == 'Admin'){
        $q = "SELECT * from temp_admins where email = '$email' ";
        $s = $this->pdo->prepare($q);
        $s->execute();
        $n = $s->fetchColumn();
        if($n == 0){
          $query = "INSERT INTO temp_admins (username,email,password,date) VALUES ('$username','$email','$passw','$date')";
          $sql = $this->pdo->prepare($query);
          $sql->execute();
          echo "<script>alert('You request has been submitted successfully..')</script>";
          echo '<script type="text/javascript">
                  window.location = "../login.php"
                </script>';
        } else{
          echo "<script>alert('Account with these fields already exists..')</script>";

          echo '<script type="text/javascript">
                    window.location = "../register.php"
                    </script>';
        }
      } else{
        $query = "INSERT INTO forumusers (username,email,password,accountType,date) VALUES ('$username','$email','$passw','Student','$date')";
        $sql = $this->pdo->prepare($query);
        $sql->execute();
        echo "<script>alert('You Account has been created successfully..')</script>";
        echo '<script type="text/javascript">
                  window.location = "../login.php"
              </script>';
      }
    } else{
      echo "<script>alert('Account with these fields already exists..')</script>";
      echo '<script type="text/javascript">
                window.location = "../register.php"
            </script>';
    }
  }

  public function login($email,$password){
    $pass = md5($password);
    $q = "SELECT * from forumusers where email = '$email' and password = '$pass' ";
    $s = $this->pdo->prepare($q);
    $s->execute();
    $rows = $s->fetchAll();
    $n = count($rows);
    if($n == 1){
      $s = $this->pdo->query($q);
      $row = $s->fetch(\PDO::FETCH_ASSOC);
      $_SESSION['id']=$row['usersID'];
      $_SESSION['username']=$row['username'];
      $_SESSION['accounttype']=$row['accountType'];
      $_SESSION['email']=$row['email'];
      $_SESSION['date']=$row['date'];
      echo '<script>window.location.assign("../index.php")</script>';
    } else{
      echo '<script type="text/javascript">
              window.location = "../login.php?error=invalid username or password.."
            </script>';
    }
  }

  public function post($title,$cat,$description){
    $query = "SELECT * FROM posts WHERE title = '$title' AND category = '$cat'";
    $sql = $this->pdo->prepare($query);
    $sql->execute();
    $rows = $sql->fetchAll();
    $n = count($rows);
    if($n == 1){
      echo '<script type="text/javascript">
              window.location = "../ask.php?error=Post with same title and categories already exists..."
            </script>';
    } else {
      $by = $_SESSION['id'];
      $date = date("Y-m-d H:i:s");
      $query = "INSERT INTO posts (title,category,description,post_By,date) VALUES ('$title','$cat','$description','$by','$date')";
      $sql = $this->pdo->prepare($query);
      $sql->execute();
      echo '<script type="text/javascript">
              window.location = "../index.php"
            </script>';
    }
  }

  public function comment($comment,$post_id){
    $by = $_SESSION['id'];
    $c = str_replace("'","''",$comment);;
    $pid = $post_id;
    $date = date("Y-m-d H:i:s");
    $query = "INSERT INTO comments (postID,comment,comment_By,date) VALUES ('$pid','$c','$by','$date')";
    $sql = $this->pdo->prepare($query);
    $result = $sql->execute();
    if ($result) {
      echo '<script type="text/javascript">
              window.location = "../discussion.php?id='.$pid.'"
            </script>';
    } else {
      echo '<script>
              alert("Error: Please try again...<br>");
              window.location = "../discussion.php?id='.$pid.'"
            </script>';
    }
  }

  public function showposts($limit){
    $query = "Select * from posts ORDER BY views DESC LIMIT $limit";
    $sql = $this->pdo->prepare($query);
    $sql->execute();

    $query1 = "Select count(*) from posts ORDER BY views DESC LIMIT $limit";
    $sql1 = $this->pdo->prepare($query1);
    $sql1->execute();

    while( $row = $sql->fetch(\PDO::FETCH_ASSOC)){
      echo '<div class="card disscusioncards" style="padding: 1px;">
              <div class="card-body">
                <h5 class="card-title">'.$row['title'].'</h5>
                <p class="card-text">';
      if (strlen($row['description']) > 150) {
        $maxLength = 149;
        $yourString = substr($row['description'], 0, $maxLength);
        echo $yourString.'...<a href="discussion.php?id='.$row['postsID'].'">Read more</a>';
      } else{
        echo $row['description'].'...<a href="discussion.php?id='.$row['postsID'].'">Read more</a>';
      }
      echo '</p>
          <a style="float: right;background-color: #000;" href="discussion.php?id='.$row['postsID'].'" class="btn btn-dark">Read more..</a>
        </div>
      </div>';
    }
    if($sql1->fetchColumn() > 4){
      echo '<center><button id="randomseemore" class="btn btn-dark m-4">See more...</button></center>';
    }
  }

  public function deletecomment($cmntid,$pid){
    $query1 = "DELETE FROM comments where commentsID = '$cmntid' and postID = '$pid' " ;
    $sql1 = $this->pdo->prepare($query1);
    $sql1->execute();

    $query2 = "DELETE FROM reportedcomments where commentID = '$cmntid' and postID = '$pid' " ;
    $sql2 = $this->pdo->prepare($query2);
    $sql2->execute();

    return 1;

  }

  public function ignore_comment($cmntid,$pid){
    $query2 = "DELETE FROM reportedcomments where commentID = '$cmntid' and postid = '$pid' " ;
    $sql2 = $this->pdo->prepare($query2);
    $sql2->execute();
    return 1;
  }

  public function showmyposts(){
    $by = $_SESSION['id'];
    $query = "SELECT * FROM posts WHERE post_By = '$by' order by date DESC";
    $sql = $this->pdo->prepare($query);
    $sql->execute();
    while( $row = $sql->fetch(PDO::FETCH_ASSOC)){
      echo '<div class="card disscusioncards" style="padding: 1px;margin:2px;">
            <div class="card-body">
              <a href="discussion.php?id='.$row['postsID'].'" ><p class="card-text">'.$row['title'].'</p>
              </a>
              <button class="postdelete btn btn-danger" id="'.$row['postsID'].'" style="float: right;" ><i class="fa fa-trash"></i></button>
            </div>
          </div>';
    }
  }

  public function showmycomments(){
    $by = $_SESSION['id'];
    $query = "SELECT * FROM comments WHERE comment_By = '$by' order by date DESC";
    $sql = $this->pdo->prepare($query);
    $sql->execute();
    while( $row = $sql->fetch(PDO::FETCH_ASSOC)){
      echo '<div class="card disscusioncards" style="padding: 1px;margin:2px;">
          <div class="card-body">
          <p class="card-text postid" id="'.$row['commentsID'].'">';


      if (strlen($row['comment']) > 200) {
          $maxLength = 199;
          $yourString = substr($row['comment'], 0, $maxLength);
          echo $yourString.'...<a href="discussion.php?id='.$row['postid'].'">Read more</a>';
      } else{
        echo $row['comment'].'<a href="discussion.php?id='.$row['postID'].'">...Read more</a>';

      }
      echo '</p><button style="float: right;" id="'.$row['postID'].'" class="delete btn btn-danger"><i class="fa fa-trash"></i></button>

        </div>
      </div>';
    }
  }

  public  function showreportedcomments(){

    $q = "SELECT * FROM reportedcomments order by date DESC";
    $sql = $this->pdo->prepare($q);
    $sql->execute();

    while (  $row = $sql->fetch(PDO::FETCH_ASSOC)) {
      $q1 = "SELECT * FROM forumusers where usersID = ".$row['reported_By']." ";
      $sql1 = $this->pdo->prepare($q1);
      $sql1->execute();
      //echo mysqli_error($this->pdo);
      $user = $sql1->fetch(PDO::FETCH_ASSOC);

      $q2 = "SELECT * FROM comments where commentsID = ".$row['commentID']." ";
      $sql2 = $this->pdo->prepare($q2);
      $sql2->execute();
      $details = $sql2->fetch(PDO::FETCH_ASSOC);
      echo '<div class="card disscusioncards" style="padding: 1px;margin:2px;">
              <div class="card-body">
                <h6 class="card-title">Reported By : '.$user['username'].'</h6>
                <p class="card-text postid" id="'.$row['commentID'].'">';

      if (strlen($details['comment']) > 200) {
        $maxLength = 199;
        $yourString = substr($details['comment'], 0, $maxLength);
        echo $yourString.'...<a href="discussion.php?id=/'.$row['postID'].'">Read more</a>';
      } else {
        echo $details['comment'].'<a href="discussion.php?id='.$row['postID'].'">...Read more</a>';
      }
      echo '</p>
      <button style="float: right;" id="'.$details['postID'].'" class="m-2 delete btn btn-danger"><i class="fa fa-trash"></i></button>
      <button style="float: right;" id="'.$details['postID'].'" class="m-2 ignore_comment btn btn-success"><i class="fa fa-remove"></i></button>

              </div>
              </div>




                  ';
                  }

  }

  public function showadminrequests(){
    $q = "SELECT * FROM temp_admins order by date DESC";
    $sql = $this->pdo->prepare($q);
    $sql->execute();

    while (  $row = $sql->fetch(PDO::FETCH_ASSOC)) {

                        echo '



                  <div class="card disscusioncards" style="padding: 1px;margin:2px;">
                  <div class="card-body">
                  <h6 class="card-title">'.$row['username'].'</h6>
                  <p class="card-text">'.$row['email'].'

                  <button style="float: right;" id="'.$row['adminsID'].'" class="deleteadmin btn btn-danger m-1"><i class="fa fa-trash"></i></button>


                  <button style="float: right;" id="'.$row['adminsID'].'"  class="acceptadmin btn btn-success m-1"><i class="fa fa-check"></i></button></p>

                  </div>
                  </div>




                  ';
                  }

  }

  public function confirm_admin($id){
    $q1 = "SELECT * FROM temp_admins WHERE adminsID = '$id' ";
    $sql1 = $this->pdo->prepare($q1);
    $sql1->execute();
    $row = $sql1->fetch(PDO::FETCH_ASSOC);

    $query = "INSERT INTO forumusers (username,email,password,accountType,date) VALUES ('".$row['username']."','".$row['email']."','".$row['password']."','Admin',datetime('now'))";
    $sql = $this->pdo->prepare($query);
    $sql->execute();

    if($sql = true){
      $q2 = "DELETE from temp_admins where adminsID = '$id'";

      $sql2 = $this->pdo->prepare($q2);
      $sql2->execute();
      echo 1;
    } else{
      echo 0;
    }
  }

  public function delete_admin($id){
    $q = "DELETE from temp_admins where adminsID = '$id' ";
    $sql = $this->pdo->prepare($q);
    $sql->execute();
    echo 1;
  }

  public function report_comment($cid,$pid){
    $by = $_SESSION['id'];
    $sql = "SELECT count(*) FROM reportedcomments
            WHERE commentID = '$cid' AND postID = '$pid' AND reported_by = '$by'";
    $sql = $this->pdo->prepare($sql);
    $sql->execute();
    $chk = $sql->fetchColumn();
    if($chk == 0 ){
      $query = "INSERT INTO reportedcomments (postID,commentID,reported_By,date) VALUES ('$pid','$cid','$by',datetime('now'))";
      $sql = $this->pdo->prepare($query);
      $sql->execute();
      echo 1;
    }
    else{

    }
  }

  public function upvote($post_id){
    $id = $_SESSION['id'];

    $q1 = "SELECT count(*) FROM response WHERE type = 1 AND postID= '$post_id' AND response_By = '$id' ";
    $sql1 = $this->pdo->prepare($q1);
    $sql1->execute();

    if($sql1->fetchColumn() == 0){


//Check for devotes

    $qd = "SELECT count(*) FROM response WHERE type = 0 AND postID= '$post_id' AND response_By = '$id' ";
    $sqld = $this->pdo->prepare($qd);
    $sqld->execute();
    if($sqld->fetchColumn() == 1){
      $query = "DELETE FROM response where postID = '$post_id' and response_By = '$id' AND type = 0 " ;
      $sql = $this->pdo->prepare($query);
      $sql->execute();
    }


      $q2 = "INSERT INTO response (postID,response_By,type,date) VALUES ('$post_id','$id',1,datetime('now'))";
      $sql2 = $this->pdo->prepare($q2);
      $sql2->execute();



      $q3 = "SELECT count(*) FROM response WHERE type = 1 AND postID = '$post_id' ";
      $sql3 = $this->pdo->prepare($q3);
      $sql3->execute();
      $upvotes = $sql3->fetchColumn();


      $q4 = "SELECT count(*) FROM response WHERE type = 0 AND postID = '$post_id' ";
      $sql4 = $this->pdo->prepare($q4);
      $sql4->execute();

      $devotes = $sql4->fetchColumn();

      $response = array('upvotes' => $upvotes,'devotes' =>$devotes ,'check' => 1);

      return json_encode($response);

    }

    else{


       $update_veiws = "DELETE FROM response WHERE postID = '$post_id' and response_By = '$id' AND type = 1 ";
          $sql = $this->pdo->prepare($update_veiws);
          $sql->execute();

      $q3 = "SELECT count(*) FROM response WHERE type = 1 AND postID = '$post_id' ";
      $sql3 = $this->pdo->prepare($q3);
      $sql3->execute();
      $upvotes = $sql3->fetchColumn();


      $q4 = "SELECT count(*) FROM response WHERE type = 0 AND postID = '$post_id' ";
      $sql4 = $this->pdo->prepare($q4);
      $sql4->execute();

      $devotes = $sql4->fetchColumn();

      $response = array('upvotes' => $upvotes,'devotes' =>$devotes,'check' => 0 );

      return json_encode($response);
    }
  }

  public function devote($post_id){
    $id = $_SESSION['id'];

    $q = "SELECT count(*) FROM response WHERE type = 0 AND postID = '$post_id' AND response_By = '$id' ";
    $sql = $this->pdo->prepare($q);
    $sql->execute();

    if($sql->fetchColumn() == 0){

//check for upvotes
      //Check for devotes

    $qd = "SELECT count(*) FROM response WHERE type = 1 AND postID= '$post_id' AND response_By = '$id' ";
    $sqld = $this->pdo->prepare($qd);
    $sqld->execute();
    if($sqld->fetchColumn() == 1){
      $query = "DELETE FROM response where postID = '$post_id' and response_By = '$id' AND type = 1 " ;
      $sql = $this->pdo->prepare($query);
      $sql->execute();
    }


      $query = "INSERT INTO response (postID,response_By,type,date) VALUES ('$post_id','$id',0,datetime('now'))";
      $sql = $this->pdo->prepare($query);
      $sql->execute();


      $q3 = "SELECT count(*) FROM response WHERE type = 1 AND postID = '$post_id' ";
      $sql3 = $this->pdo->prepare($q3);
      $sql3->execute();
      $upvotes = $sql3->fetchColumn();


      $q4 = "SELECT count(*) FROM response WHERE type = 0 AND postID = '$post_id' ";
      $sql4 = $this->pdo->prepare($q4);
      $sql4->execute();

      $devotes = $sql4->fetchColumn();

      $response = array('upvotes' => $upvotes,'devotes' =>$devotes , 'check' => 1 );

      return json_encode($response);
    }else{
      $query = "DELETE FROM response where postID = '$post_id' and response_By = '$id' AND type = 0 " ;
      $sql = $this->pdo->prepare($query);
      $sql->execute();

      $q3 = "SELECT count(*) FROM response WHERE type = 1 AND postID = '$post_id' ";
      $sql3 = $this->pdo->prepare($q3);
      $sql3->execute();
      $upvotes = $sql3->fetchColumn();


      $q4 = "SELECT count(*) FROM response WHERE type = 0 AND postID = '$post_id' ";
      $sql4 = $this->pdo->prepare($q4);
      $sql4->execute();

      $devotes = $sql4->fetchColumn();

      $response = array('upvotes' => $upvotes,'devotes' =>$devotes , 'check' => 0 );

      return json_encode($response);
    }
  }

  public function delete_post($postid){
    $post_id =  $postid;
    $postby = $_SESSION['id'];

    $q1 = "DELETE from posts where postsID  = '$postid'  ";
    $s1 = $this->pdo->prepare($q1);
    $s1->execute();

    $q2 = "DELETE from comments where postID  = '$postid' ";
    $s2 = $this->pdo->prepare($q2);
    $s2->execute();
    $q4 = "DELETE from reportedcomments where postID = '$postid' ";
    $s4 = $this->pdo->prepare($q4);
    $s4->execute();
    $q5 = "DELETE from response where postID = '$postid' ";
    $s5 = $this->pdo->prepare($q5);
    $s5->execute();

echo 1;

  }

  public function sort_posts($postid,$sortby,$limit){
          $qc = "SELECT count(*) FROM comments WHERE postID = '$postid' order by date DESC";
      $sqlc = $this->pdo->prepare($qc);
      $sqlc->execute();

    if($sortby == "newest"){
      $q = "SELECT * FROM comments WHERE postID = '$postid' order by date DESC LIMIT '$limit' ";
      $sql = $this->pdo->prepare($q);
      $sql->execute();
      

			while($reply = $sql->fetch(PDO::FETCH_ASSOC)){
				$userid = $reply['comment_By'];
				echo '<div class="row">
					<div class="col-md-12">
						<div class="card">
						<div class="card-header">
						<div class="media flex-wrap w-100 align-items-center">
						<div class="media-body ml-3"><a " class="h6" data-abc="true">';

						self::show_user($userid);

						echo '</a>
						<div><sup>Posted on '.$reply['date'].'</sup></div>
						</div>
						<div class="text-muted small ml-3">
						';
						if(isset($_SESSION['id'])){
						if($userid == $_SESSION['id'] || $_SESSION['accounttype'] == 'Admin' ){
						echo ' <div> <button id="'.$reply['commentsID'].'" type="button" class="btn delete"><i class="ion ion-md-create fa fa-trash"></i></button> </div>';
						}else{

						echo '<button type="button" id="'.$reply['commentsID'].'" class="btn report"><i class="fa fa-ban"></i></button> ' ; }}

						echo '
						</div>
						</div>
						</div>
						<div class="card-body">
						<p>'.nl2br($reply['comment']).'
						</p>
						</div>
						</div>
					</div>
				</div>';
			}

            if($sqlc->fetchColumn() > 4){
        echo '<center><button id="seemore" class="btn btn-dark m-4">See more...</button></center>';
      }

		} else{
			$q = "SELECT * FROM comments WHERE postID = '$postid' order by date ASC";
			$sql = $this->pdo->prepare($q);
			$sql->execute();
			while($reply = $sql->fetch(PDO::FETCH_ASSOC)){
				$userid = $reply['comment_By'];
				echo '<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="media flex-wrap w-100 align-items-center">
                  <div class="media-body ml-3"><a class="h6" data-abc="true">';
                    self::show_user($userid);
                    echo '</a>
                    <div><sup>Posted on '.$reply['date'].'</sup></div>
                  </div>
                  <div class="text-muted small ml-3">';
                  if(isset($_SESSION['id'])){
                    if($userid == $_SESSION['id'] || $_SESSION['accounttype'] == 'Admin' ){
                      echo ' <div> <button id="'.$reply['commentsID'].'" type="button" class="btn delete"><i class="ion ion-md-create fa fa-trash"></i></button> </div>';
                    }else{
                      echo '<button type="button" id="'.$reply['commentsID'].'" class="btn report"><i class="fa fa-ban"></i></button> ' ;
                    }
                  }
                echo '
                  </div>
                </div>
              </div>
              <div class="card-body">
                <p>'.nl2br($reply['comment']).'</p>
              </div>
            </div>
          </div>
        </div>';
			}
    }

                if($sqlc->fetchColumn() > 4){
        echo '<center><button id="seemore" class="btn btn-dark m-4">See more...</button></center>';
      }
  }

  public function showtotalposts(){
    $id = $_SESSION['id'];
    $query = "SELECT * FROM posts WHERE post_By = '$id' ";
    $sql = $this->pdo->prepare($query);
    $sql->execute();
    $rows = $sql->fetchAll();
    $num = count($rows);
    echo $num;
  }

  public function showtotalreply(){
    $id = $_SESSION['id'];
    $query = "SELECT COUNT(*) FROM comments WHERE comment_By = '$id' ";
    $sql = $this->pdo->query($query);
    $num = $sql->fetchColumn();
    echo $num;
  }
}
