<?php
$nama    = "Mohamad Fasafa Hubaidilah";
$student = 'Student at UPN Veteran Jawa Timur 2021 <br /><span style="color: #fc1359">Informatics</span>';
$about   = "Need Learning and experience, interested in DevOps and Back-end Engineer";
$noHP    = "+(62) 812 3480 9260";
$email   = "mfasafa@gmail.com";
$gender  = "Male";
$language= "Indonesia, English"; 
$alamat  = "Jln. Kapten Tendean Gg. Karya No. 15 Jombang Jawa Timur";
$lorem   = "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corrupti accusantium vitae nobis deleniti molestiae inventore quo a dicta, quas tempore deserunt non nam amet, dolorum facilis. Dolorum pariatur illo beatae.";
$edukasi = array(
  array(
    array(
      "jenjang" => "Elementary School",
      "tempat"  => "SDIT AL-UMMAH Jombang",
      "tahun"   => "2009 - 2015"
    ),
    array(
      "jenjang" => "Senior High School",
      "tempat"  => "SMA Negeri 2 Jombang",
      "tahun"   => "2018 - 2021"
    ),
  ),
  array(
    array(
      "jenjang" => "Junior High School",
      "tempat"  => "SMP Negeri 2 Jombang",
      "tahun"   => "2015 - 2018"
    ),
    array(
      "jenjang" => "College",
      "tempat"  => "UPN \"Veteran\" Jawa Timur",
      "tahun"   => "2021 - Now"
    )
  )
);
$skills = array(
  array(
    array(
      "nama"   => "HTML",
      "persen" => 50
    ),
    array(
      "nama"   => "CSS",
      "persen" => 30
    ),
    array(
      "nama"   => "PHP",
      "persen" => 55
    ),
    array(
      "nama"   => "JavaScript",
      "persen" => 20
    ),
  ),
  array(
    array(
      "nama"   => "C++",
      "persen" => 30
    ),
    array(
      "nama"   => "Java",
      "persen" => 25
    ),
    array(
      "nama"   => "Python",
      "persen" => 45
    ),
    array(
      "nama"   => "Dart",
      "persen" => 30
    ),
  )
);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Biodata</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="atas">
      <div class="kotak1">
        <div class="baris kotakfoto1">
          <div class="kotakfoto2">
            <img
              class="foto"
              src="img/hubed_waifu2x_photo_noise3_scale-removebg-preview-removebg-preview.png"
              alt="foto_hubed"
            />
          </div>
        </div>
        <div class="baris ovaltengah1">
          <div class="ovaltengah2">
            <div class="kotakdalamoval">
              <div class="baris" style="height: 90%">
                <a class="kolom" href="#profile"
                  ><div class="butonoval"><h2>Profile</h2></div></a
                >
                <a class="kolom" href="#profile"
                  ><div class="butonoval"><h2>Contact</h2></div></a
                >
                <a class="kolom" href="#education"
                  ><div class="butonoval"><h2>Education</h2></div></a
                >
                <a class="kolom" href="#skill"
                  ><div class="butonoval"><h2>Skill</h2></div></a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="baris">
        <div class="kolom kotak2">
          <div class="baris">
            <div class="kolom header">
              <div class="baris">
                <div class="kolom" style="width: 20%; height: 80px">
                  <img class="foto" src="img/logoupnbaru.png" alt="logoupn" />
                </div>
                <div class="kolom" style="width: 80%; height: 80px">
                  <div class="baris">
                    <div class="kolom" style="width: 30%; height: 60px"></div>
                    <div class="kolom" style="width: 65%; height: 60px">
                      <div
                        class="baris"
                        style="position: relative; z-index: 10"
                      >
                        <a class="kolom" href="#"
                          ><div class="butonheader"><h3>Home</h3></div></a
                        >
                        <a class="kolom" href="#profile"
                          ><div class="butonheader"><h3>Profile</h3></div></a
                        >
                        <a class="kolom" href="https://stakom.hoaks.my.id"
                          ><div class="butonheader"><h3>Blog</h3></div></a
                        >
                        <a class="kolom" href="https://stakom.hoaks.my.id/admin"
                          ><div class="butonheader"><h3>Login</h3></div></a
                        >
                      </div>
                    </div>
                    <div class="kolom" style="width: 5%; height: 60px"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="baris kotakbesarataskiri">
            <div class="kotak3">
              <div class="baris kotak4">
                <div class="kotak5">
                  <h3>it's me</h3>
                  <img src="img/chat.png" alt="chat" class="foto" />
                </div>
              </div>
              <div class="baris kotak4">
                <div class="kotaknama"><h1><?= $nama ?></h1></div>
              </div>
              <div class="baris kotak6">
                <div class="kotakstuden">
                  <h3 style="margin: 0">
                    <?= $student ?>
                  </h3>
                </div>
              </div>
              <div class="baris kotak6">
                <div class="kotak7">
                  <a
                    href="https://www.linkedin.com/in/mohamad-fasafa-hubaidilah-7ab336194/"
                    ><div class="kotakbuton">
                      <h2>Touch me!</h2>
                    </div></a
                  >
                </div>
              </div>
              <div class="baris kotak8"></div>
            </div>
          </div>
        </div>
        <div class="kolom sampingkanan abu"></div>
      </div>
    </div>
    <div class="main">
      <div id="profile" class="baris warna kotak" style="margin-top: 0">
        <div class="kotak1">
          <div class="baris kotak6">
            <div class="kotak9">
              <h2>Profile</h2>
            </div>
            <div class="kotak10">
              <h2>Basic Information</h2>
            </div>
          </div>
          <div class="baris kotak11">
            <div class="kotakprofil">
              <p><?php echo $student ?></p>
              <p><?php echo $about ?></p>
              <p><?php echo $lorem ?></p>
            </div>
            <div class="kotakinfo">
              <table style="position: relative">
                <tr>
                  <td>
                    <b><p>PHONE :</p></b>
                  </td>
                  <td><p><?php echo $noHP ?></p></td>
                </tr>
                <tr>
                  <td>
                    <b><p>EMAIL :</p></b>
                  </td>
                  <td><p><?php echo $email ?></p></td>
                </tr>
                <tr>
                  <td>
                    <b><p>AGE :</p></b>
                  </td>
                  <td><p><?php echo (empty($_POST['tanggal_lahir'])) ? '<form action="#profile" method="post"><label for="tanggal_lahir">Tanggal Lahir : </label><input type="text" placeholder="yyyy-mm-dd" name="tanggal_lahir"><input type="submit" value="Submit"></form>' : date_diff(date_create($_POST['tanggal_lahir']), date_create('now'))->y // date("Y")-$_POST['tahun_lahir'] ?></p></td>
                </tr>
                <tr>
                  <td>
                    <b><p>GENDER :</p></b>
                  </td>
                  <td><p><?php echo $gender ?></p></td>
                </tr>
                <tr>
                  <td>
                    <b><p>LANGUAGE :</p></b>
                  </td>
                  <td><p><?php echo $language ?></p></td>
                </tr>
                <tr>
                  <td style="white-space: nowrap">
                    <b><p>NATIONALITY :</p></b>
                  </td>
                  <td><p>Indonesia</p></td>
                </tr>
                <tr>
                  <td style="vertical-align: top">
                    <b><p>ADDRESS :</p></b>
                  </td>
                  <td style="vertical-align: top">
                    <p><?php echo $alamat ?></p>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div
        id="education"
        class="kotak"
        style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25)"
      >
        <div class="kotak1">
          <div class="baris kotak6">
            <div class="kotak9"><h2>Education</h2></div>
          </div>
          <div class="baris kotak11">
            <div class="kotak1">
              <div class="baris kotak12">
                <?php foreach($edukasi as $edu){ ?>
                  <div class="kolom">
                    <?php foreach($edu as $subEdu){ ?>
                      <div class="baris kotak13">
                        <div class="sekondari kotaksekolah">
                          <div class="kotaktextsekolah">
                            <p><b><?php echo $subEdu['jenjang'] ?></b></p>
                            <p><?php echo $subEdu['tempat'] ?></p>
                            <p><?php echo $subEdu['tahun'] ?></p>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
                  <!-- <div class="baris kotak13">
                    <div class="sekondari kotaksekolah">
                      <div class="kotaktextsekolah">
                        <p><b>Senior High School</b></p>
                        <p>SMA Negeri 2 Jombang</p>
                        <p>2018 - 2021</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="kolom">
                  <div class="baris kotak13">
                    <div class="sekondari kotaksekolah">
                      <div class="kotaktextsekolah">
                        <p><b>Junior High School</b></p>
                        <p>SMP Negeri 2 Jombang</p>
                        <p>2015 - 2018</p>
                      </div>
                    </div>
                  </div>
                  <div class="baris kotak13">
                    <div class="sekondari kotaksekolah">
                      <div class="kotaktextsekolah">
                        <p><b>College</b></p>
                        <p>UPN "Veteran" Jawa Timur</p>
                        <p>2021 - Now</p>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="skill" class="kotak warna">
        <div class="kotak1">
          <div class="baris kotak6">
            <div class="kotak9">
              <h2>Skill</h2>
            </div>
          </div>
          <div class="baris kotak11">
            <div class="kotak1">
              <div class="baris kotak12">
                <?php foreach($skills as $skill){ ?>
                  <div class="kolom">
                    <?php foreach($skill as $subSkill){ ?>
                      <div class="baris kotak4">
                        <div class="kotak14">
                          <div class="baris kotak15">
                            <div class="kolom">
                              <h3 class="h3skill" align="left"><?php echo $subSkill['nama'] ?></h3>
                            </div>
                            <div class="kolom">
                              <h3 class="h3skill" align="right"><?php echo $subSkill['persen'] ?>%</h3>
                            </div>
                          </div>
                          <div class="baris kotakskill">
                            <hr class="barskill" style="width: <?php echo $subSkill['persen']."%" ?>" />
                            <hr class="garisskill" style="width: <?php echo 100-$subSkill['persen']."%" ?>" />
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
                  <!-- <div class="baris kotak4">
                    <div class="kotak14">
                      <div class="baris kotak15">
                        <div class="kolom">
                          <h3 class="h3skill" align="left">CSS</h3>
                        </div>
                        <div class="kolom">
                          <h3 class="h3skill" align="right">30%</h3>
                        </div>
                      </div>
                      <div class="baris kotakskill">
                        <hr class="barskill" style="width: 30%" />
                        <hr class="garisskill" style="width: 70%" />
                      </div>
                    </div>
                  </div>
                  <div class="baris kotak4">
                    <div class="kotak14">
                      <div class="baris kotak15">
                        <div class="kolom">
                          <h3 class="h3skill" align="left">PHP</h3>
                        </div>
                        <div class="kolom">
                          <h3 class="h3skill" align="right">55%</h3>
                        </div>
                      </div>
                      <div class="baris kotakskill">
                        <hr class="barskill" style="width: 55%" />
                        <hr class="garisskill" style="width: 45%" />
                      </div>
                    </div>
                  </div>
                  <div class="baris kotak4">
                    <div class="kotak14">
                      <div class="baris kotak15">
                        <div class="kolom">
                          <h3 class="h3skill" align="left">JavaScript</h3>
                        </div>
                        <div class="kolom">
                          <h3 class="h3skill" align="right">20%</h3>
                        </div>
                      </div>
                      <div class="baris kotakskill">
                        <hr class="barskill" style="width: 20%" />
                        <hr class="garisskill" style="width: 80%" />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="kolom">
                  <div class="baris kotak4">
                    <div class="kotak14">
                      <div class="baris kotak15">
                        <div class="kolom">
                          <h3 class="h3skill" align="left">C++</h3>
                        </div>
                        <div class="kolom">
                          <h3 class="h3skill" align="right">30%</h3>
                        </div>
                      </div>
                      <div class="baris kotakskill">
                        <hr class="barskill" style="width: 30%" />
                        <hr class="garisskill" style="width: 70%" />
                      </div>
                    </div>
                  </div>
                  <div class="baris kotak4">
                    <div class="kotak14">
                      <div class="baris kotak15">
                        <div class="kolom">
                          <h3 class="h3skill" align="left">Java</h3>
                        </div>
                        <div class="kolom">
                          <h3 class="h3skill" align="right">25%</h3>
                        </div>
                      </div>
                      <div class="baris kotakskill">
                        <hr class="barskill" style="width: 25%" />
                        <hr class="garisskill" style="width: 75%" />
                      </div>
                    </div>
                  </div>
                  <div class="baris kotak4">
                    <div class="kotak14">
                      <div class="baris kotak15">
                        <div class="kolom">
                          <h3 class="h3skill" align="left">Python</h3>
                        </div>
                        <div class="kolom">
                          <h3 class="h3skill" align="right">45%</h3>
                        </div>
                      </div>
                      <div class="baris kotakskill">
                        <hr class="barskill" style="width: 45%" />
                        <hr class="garisskill" style="width: 55%" />
                      </div>
                    </div>
                  </div>
                  <div class="baris kotak4">
                    <div class="kotak14">
                      <div class="baris kotak15">
                        <div class="kolom">
                          <h3 class="h3skill" align="left">Dart</h3>
                        </div>
                        <div class="kolom">
                          <h3 class="h3skill" align="right">30%</h3>
                        </div>
                      </div>
                      <div class="baris kotakskill">
                        <hr class="barskill" style="width: 30%" />
                        <hr class="garisskill" style="width: 70%" />
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="bawah">
      <div class="baris kotakbawah">
        <div class="kotakbawahkiri">
          <hr />
          <h2>Tugas PEMWEB HTML + CSS</h2>
        </div>
        <div class="kolom abu kotakbawahkanan"></div>
      </div>
    </div>
  </body>
</html>
