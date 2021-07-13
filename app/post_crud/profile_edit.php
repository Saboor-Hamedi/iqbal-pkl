  <?php
  require_once __DIR__ . '/../database/database.php';
  $db = Database::getInstance();
  $con = $db->getmyDB();
  $profile_id = "";
  $profile_bio = "";
  $profile_country = "";
  $profile_age = "";
  $profile_education = "";
  $profile_image = "";
  $profile_tmp = "";
  try {
    $profile_id = ($_POST['profile_id']);
    $profile_bio = ($_POST['profile_bio']);
    $profile_country = ($_POST['profile_country']);
    $profile_age = ($_POST['profile_age']);
    $profile_education = ($_POST['profile_education']);
    $profile_name = $_FILES['profile_image']['name'];
    $profile_ext = explode('.', $profile_name);
    $profile_actual_ext = strtolower(end($profile_ext));
    $allowed_image = array('png', 'jpg', 'jpeg');
    $profile_new = time() . mt_rand() . '.' . $profile_actual_ext;
    $profile_path = '../../public/profile_image/' . $profile_new;
    if (in_array($profile_actual_ext, $allowed_image)) {
      if ($_FILES['profile_image']['size'] > 0 && $_FILES['profile_image']['error'] == 0) {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $profile_path)) {
          $stmt = $con->prepare("SELECT image FROM profiles  WHERE user_id=?");
          $stmt->execute([$profile_id]);
          $user = $stmt->fetch();
          @unlink('../../public/profile_image/' . $user['image']);
          $sql = "UPDATE profiles SET bio= :profile_bio,
          country= :profile_country, 
          age= :profile_age,
          education =:profile_education,
          image = :profile_new
          WHERE user_id= :profile_id";
          $stmt = $con->prepare($sql);
          $data = [
            'profile_bio' => $profile_bio,
            'profile_country' => $profile_country,
            'profile_age' => $profile_age,
            'profile_education' => $profile_education,
            'profile_id' => $profile_id,
            'profile_new' => $profile_new,
          ];
          $stmt->execute($data);
          if ($stmt->rowCount()) {
            echo 'Changes has updated';
          } else {
            echo 'Nothing has changed';
          }
        }
      } else {
        echo "Unable to upload physical file";
      }
    } else {
      echo "This type of image is not allow";
    }
  } catch (PDOException $th) {
    echo 'Something went wrong!';
  }
