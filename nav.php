<?php
if(!defined('ACTIVE')) die();

if($_SESSION['username'] && $_SESSION['id'] && $_SESSION['admin'] == "1"){
echo "<div class=\"navcontainer\"><!-- Nav start -->

<div id='cssmenu'><!-- Menu Start -->
<ul>
   <li class='active'><a href='index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Jobs Admin</span></a>
      <ul>
         <li><a href='addjob.php'><span>Add Jobs</span></a></li>
         <li class='last'><a href='viewjobs.php'><span>View Jobs</span></a></li>
      </ul>
   </li>
      <li class='has-sub'><a href='#' title='Check information held on you'><span>Profile</span></a>
      <ul>
         <li><a href='profile.php'><span>View Information Held</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Admin Tools</span></a>
      <ul>
		 <li><a href='sitestats.php'><span>Site Statistics</span></a></li>
         <li><a href='viewcoach.php'><span>View Work Coach</span></a></li>
         <li class='last'><a href='workcoach.php'><span>Add Work Coach</span></a></li>
      </ul>
   </li>
   <li class='last'><a href='?logout'><span>Logout</span></a></li>
</ul>
</div><!-- Menu End -->
</div><!-- Nav End -->";
}
else{
if($_SESSION['username'] && $_SESSION['id'] && $_SESSION['admin'] == ""){
echo "<div class=\"navcontainer\"><!-- Nav start -->

<div id='cssmenu'><!-- Menu Start -->
<ul>
   <li class='active'><a href='index.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Jobs Admin</span></a>
      <ul>
         <li><a href='addjob.php'><span>Add Jobs</span></a></li>
         <li class='last'><a href='viewjobs.php'><span>View Jobs</span></a></li>
      </ul>
   </li>
      <li class='has-sub'><a href='#' title='Check information held on you'><span>Profile</span></a>
      <ul>
         <li><a href='profile.php'><span>View Information Held</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>Admin Tools</span></a>
      <ul>
         <li><a href='viewcoach.php'><span>View Work Coach</span></a></li>
         <li class='last'><a href='workcoach.php'><span>Add Work Coach</span></a></li>
      </ul>
   </li>
   <li class='last'><a href='?logout'><span>Logout</span></a></li>
</ul>
</div><!-- Menu End -->
</div><!-- Nav End -->";
}
}
?>