<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <title>Brgy. Yuson Information Management System</title>
  </head>

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap");

:root {
  --primary-color: #2f2f2f;
  --text-dark: #18181b;
  --text-light: #71717a;
  --white: #ffffff;
  --max-width: 1200px;
  --header-font: "Lora", serif;
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

.section__container {
  max-width: var(--max-width);
  margin: auto;
  padding: 7rem 2rem;
}

.section__header {
  margin-bottom: 1rem;
  font-size: 2rem;
  font-weight: 700;
  font-family: var(--header-font);
  color: var(--text-dark);
}

.section__subheader {
  color: var(--text-light);
  text-align: justify;
}


.btn {
  padding: 0.75rem 2rem;
  font-size: 1rem;
  color: var(--white);
  background-color: var(--primary-color);
  border-radius: 5rem;
  cursor: pointer;
  transition: 0.3s;
}

.btn:hover {
  background-color: var(--text-dark);
}

img {
  display: flex;
  width: 100%;
}

a {
  text-decoration: none;
}

html,
body {
  scroll-behavior: smooth;
}

body {
  font-family: "Poppins", sans-serif;
}

header {
  background-image: linear-gradient(
      to bottom,
      rgba(0, 0, 0, 0.8),
      rgba(0, 0, 0, 0.2)
    ),
    url("icons/bg.jpg");
  background-position: center center;
  background-size: cover;
  background-repeat: no-repeat;
}

nav {
  max-width: 100%; /* Set max-width to 100% */
  margin: auto;
  padding: .1rem 4rem; /* Adjust padding as needed */
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #007bff;
  position: fixed;
  top: 0;
  left: 0;
  right: 0; /* Stretch horizontally */
  z-index: 999; /* Ensure it's above other content */
}
/* Media Query for smaller screens */
@media screen and (max-width: 768px) {
  nav {
    padding: .1rem 1rem; /* Adjust padding for smaller screens */
  }

  .nav__menu__btn {
    display: block; /* Show the menu button on smaller screens */
    font-size: 1.5rem;
    color: var(--white);
  }

  .nav__links {
    position: absolute; /* Position the links dropdown */
    top: 68px;
    left: 0;
    width: 100%;
    flex-direction: column;
    transform: scaleY(0);
    transform-origin: top;
    transition: 0.5s;
    background-color: #007bff;
    justify-content: flex-end; /* Align items to the end */
  }

  .nav__links .link a {
    opacity: 0;
  }

  .nav__links.open .link a {
    opacity: 1;
  }

  .nav__links.open {
    transform: scaleY(1);
  }
}
.nav__logo {
  flex: 1;
}

.nav__logo a {
  font-size: 1.5rem;
  font-weight: 600;
  font-family: var(--header-font);
  color: var(--white);
}

.nav__links {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 2rem;
}

.link a {
  position: relative;
  padding: 10px 0;
  color: var(--white);
  transition: 0.3s;
}

.link a::after {
  position: absolute;
  content: "";
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  height: 2px;
  width: 0;
  background-color: var(--white);
  transition: 0.3s;
}

.link a:hover::after {
  width: 100%;
}

.nav__menu__btn {
  display: none;
  font-size: 1.5rem;
  color: var(--white);
}

.nav__actions {
  flex: 0.5;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  gap: 2rem;
}

.nav__actions span {
  font-size: 1.2rem;
  color: var(--white);
  cursor: pointer;
}

.header__container {
  text-align: center;
  color: var(--white);
}

.header__container h1 {
  margin-bottom: 1rem;
  font-size: 4.5rem;
  font-weight: 600;
  font-family: var(--header-font);
}

.header__container p {
  max-width: 600px;
  margin-inline: auto;
  margin-bottom: 4rem;
  font-size: 1.2rem;
}

.header__container form {
  width: 100%;
  max-width: 350px;
  margin-inline: auto;
  margin-bottom: 4rem;
  padding-block: 0.25rem;
  padding-inline: 1.25rem 0.25rem;
  display: flex;
  align-items: center;
  backdrop-filter: blur(10px);
  border: 1px solid var(--white);
  border-radius: 5rem;
}

.header__container input {
  width: 100%;
  outline: none;
  border: none;
  font-size: 1rem;
  color: var(--white);
  background-color: transparent;
}

.header__container input::placeholder {
  color: var(--white);
}

.header__container button {
  padding: 11px 12px;
  font-size: 1.25rem;
  outline: none;
  border: none;
  color: var(--white);
  background-color: var(--primary-color);
  border-radius: 100%;
  cursor: pointer;
}

.header__container a {
  display: inline-block;
  padding: 0 12px;
  font-size: 3rem;
  color: var(--white);
  backdrop-filter: blur(10px);
  border: 1px solid var(--white);
  border-radius: 100%;
}
.choose__container {
  position: relative;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  align-items: center;
  margin-left: 8%; /* Adjust as needed */
  margin-right: 0%; /* Adjust as needed */
}

.choose__container .choose__bg {
  position: absolute;
  top: 1rem;
  left: 50%;
  transform: translateX(-3rem);
  max-width: 300px;
  opacity: 0.4;
  z-index: -1;
}

.choose__grid {
  margin-top: 2rem;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 2rem 1rem;
}

.choose__card span {
  display: inline-block;
  margin-bottom: 0.5rem;
  padding: 5px 10px;
  font-size: 1.25rem;
  background-color: #cad8d8;
  border-radius: 100%;
}

.choose__card h4 {
  margin-bottom: 1rem;
  font-size: 1rem;
  font-weight: 600;
  font-family: var(--header-font);
  color: var(--text-dark);
}

.choose__card p {
  color: var(--text-light);
}

.choose__image img {
  max-width: 60%;
  margin: auto;
  border: none; /* Remove the border */
}

.nav__logo a {
  font-size: 1.5rem;
  font-weight: 600;
  font-family: var(--header-font);
  color: var(--white);
  text-align: center;
}

@media screen and (max-width: 768px) {
  .choose__container {
    grid-template-columns: 1fr; /* Change to single column layout on smaller screens */
    margin-left: 0px; /* Adjust margin for smaller screens */
    margin-right: 0px; /* Adjust margin for smaller screens */
  }

  .choose__container .choose__bg {
    display: none; /* Hide background image on smaller screens */
  }
}


.offer__container {
  padding-block: 5rem;
  display: grid;
  grid-template-columns:
    minmax(0, 1fr)
    minmax(0, var(--max-width))
    minmax(0, 1fr);
  row-gap: 2rem;
}

.offer__grid__top {
  grid-column: 1/3;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
}

.offer__grid__bottom {
  grid-column: 2/4;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
}

.offer__container img {
  border-radius: 10px;
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
}

.offer__content {
  padding-right: 1rem;
}

.offer__content .section__subheader {
  margin-bottom: 2rem;
}

.craft__container {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2rem;
  align-items: center;
}

.craft__container .section__subheader {
  margin-bottom: 2rem;
}

.craft__image {
  position: relative;
  isolation: isolate;
}

.craft__image::before {
  position: absolute;
  content: "";
  bottom: 0;
  left: 0;
  width: 100%;
  height: 50%;
  background-color: #ebf1f1;
  border-radius: 15px;
  transition: 0.3s;
  z-index: -1;
}

.craft__image:hover::before {
  height: 80%;
}

.craft__image__content {
  padding-bottom: 2rem;
  text-align: center;
  transition: 0.3s;
}

.craft__image__content img {
  margin-bottom: 1rem;
  max-width: 250px;
  margin: auto;
}

.craft__image__content p {
  font-size: 1rem;
  font-weight: 500;
  color: var(--text-dark);
}

.craft__image__content h4 {
  font-size: 1.2rem;
  font-weight: 600;
  color: var(--text-dark);
}

.craft__image:hover .craft__image__content {
  transform: translateY(-2rem);
}

.craft__image a {
  position: absolute;
  left: 50%;
  bottom: 10px;
  transform: translate(-50%, 50%);
  padding: 0 7px;
  font-size: 1.75rem;
  color: var(--white);
  background-color: var(--primary-color);
  border-radius: 100%;
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
  opacity: 0;
  transition: 0.3s;
}

.craft__image:hover a {
  opacity: 1;
}


.testimonial__container .section__header {
  text-align: center;
}

.swiper {
  margin-top: 2rem;
  padding-bottom: 2rem;
  width: 100%;
}

.testimonial__card {
  max-width: 900px;
  margin: auto;
  padding: 1rem;
  text-align: center;
}

.testimonial__card p {
  margin-bottom: 1rem;
  font-size: 1.1rem;
  color: var(--text-dark);
}

.testimonial__card img {
  max-width: 300px;
  margin-inline: auto;
  margin-bottom: 1rem;
  border-radius: 100%;
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
}

.testimonial__card h4 {
  font-size: 2rem;
  font-weight: 600;
  color: var(--text-dark);
}

.testimonial__card h5 {
  font-size: 1rem;
  font-weight: 500;
  color: var(--text-light);
}

.blog__grid {
  margin-top: 4rem;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 2rem;
}

.blog__card img {
  margin-bottom: 1rem;
  border-radius: 10px;
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
}

.blog__card h4 {
  font-size: 1.2rem;
  font-weight: 600;
  color: var(--text-dark);
}

.blog__card p {
  font-weight: 500;
  color: var(--text-dark);
}

.blog__card p span {
  font-weight: 400;
  font-style: italic;
  color: var(--text-light);
}

.footer {
  background-color: #007bff;
  padding-top: 10px;
}

.footer__container {
  padding: 0px;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 5rem; /* Reduced the gap */
  align-items: center;
  border-bottom: 1px solid var(--white);
}

.footer__form form {
  width: 100%;
  max-width: 400px; /* Reduced max-width */
  margin-inline: auto;
  padding: 5px;
  display: flex;
  align-items: center;
  gap: 1rem;
  background-color: var(--white);
  border-radius: 10px;
}

.footer__content h4 {
  margin-bottom: 1rem;
  font-size: 2rem;
  font-weight: 600;
  line-height: 2.5rem;
  color: var(--white);
}

.footer__content p {
  color: var(--white);
}

.footer__form form {
  width: 100%;
  max-width: 600px;
  margin-inline: auto;
  padding: 5px;
  display: flex;
  align-items: center;
  gap: 1rem;
  background-color: var(--white);
  border-radius: 10px;
}



.footer__bar {
  padding-block: 2rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 2rem;
}

.footer__logo h4 a {
  font-size: 1.5rem;
  font-weight: 600;
  font-family: var(--header-font);
  color: var(--white);
}

.footer__logo p {
  margin-top: 5px;
  font-size: 0.8rem;
  color: var(--white);
}

.footer__nav {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 1rem;
}

.footer__link a {
  font-weight: 500;
  color: var(--white);
  white-space: nowrap;
}

/* Media Query for smaller screens */
@media screen and (max-width: 768px) {
  .footer__container {
    grid-template-columns: 1fr; /* Change to a single column layout */
    gap: 3rem; /* Adjust gap */
    padding: 0 20px; /* Add padding to the sides */
  }

  .footer__form form {
    max-width: 100%; /* Adjust max-width to fill the container */
  }
}
@media (width < 1200px) {
  .offer__container {
    row-gap: 1rem;
  }

  .offer__grid__top,
  .offer__grid__bottom {
    gap: 1rem;
    grid-template-columns: repeat(3, 1fr);
  }

  .offer__grid__top img:first-child,
  .offer__grid__bottom img:first-child {
    display: none;
  }

  .craft__container {
    gap: 1rem;
  }
}

@media (width < 900px) {
  .nav__actions {
    display: none;
  }

  .choose__container {
    grid-template-columns: repeat(1, 1fr);
    margin-left: 0px;
    margin-right: 0px;
  }

  .choose__container .choose__bg {
    left: 0;
    transform: translateX(0);
  }
  .offer__grid__top,
  .offer__grid__bottom {
    grid-template-columns: repeat(2, 1fr);
  }

  .offer__grid__top img:nth-child(2),
  .offer__grid__bottom img:nth-child(4) {
    display: none;
  }

  .craft__container {
    grid-template-columns: repeat(2, 1fr);
  }

  .modern__container {
    grid-template-columns: repeat(1, 1fr);
    gap: 4rem;
  }

  .blog__grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
  }

  .footer__container {
    grid-template-columns: repeat(1, 1fr);
    text-align: center;
  }
}

@media (width < 600px) {
  nav {
    position: fixed;
    width: 100%;
    padding: 1rem;
    background-color: #007bff;
    z-index: 99;
  }

 .nav__links {
  position: absolute;
  top: 100px;
  padding: 2rem;
  width: 100%;
  flex-direction: column;
  transform: scaleY(0);
  transform-origin: top;
  transition: 0.5s;
   background-color: rgba(0, 123, 255, 0.9); /* Adjusted background color with opacity */
  justify-content: flex-end; /* Align items to the end */
}

.nav__links .link a {
  opacity: 0;
}

.nav__links.open .link a {
  opacity: 1;
}

.nav__links.open {
  transform: scaleY(1);
}

  .nav__menu__btn {
    display: block;
  }

  .header__container h1 {
    margin-top: 4rem;
    font-size: 3.5rem;
  }

  .offer__grid__top,
  .offer__grid__bottom {
    padding-inline: 1rem;
    grid-template-columns: repeat(1, 1fr);
  }

  .blog__grid {
    grid-template-columns: repeat(1, 1fr);
    row-gap: 2rem;
  }

  .footer__bar {
    flex-direction: column;
  }
}
.contact-box {
  background-color: rgba(240, 240, 240, 0.6); /* Reduced opacity */
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;
  width: 100%;
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
  height: 280px; /* Adjusted height */
  overflow-y: auto; /* Added overflow-y for scrolling if content exceeds height */
}

.contact-box h2 {
  margin-bottom: 15px;
  color: black;
}

.contact-box p {
  margin-bottom: 5px;
  font-size: 25px;
  color: black;
}
/* Responsive adjustments */
@media screen and (max-width: 768px) {
  .contact-box p {
    font-size: 20px; /* Adjust font size for smaller screens */
  }
}
/* Media Query for smaller screens */
@media screen and (max-width: 600px) {
  .contact-box {
    width: 100%;
    padding: 10px;
    height: auto; /* Set height to auto for smaller screens */
  }
}

/* Scroll to top button styles */
#scrollTopBtn {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 50px;
    z-index: 99;
    border: none;
    outline: none;
    background-color: rgba(17, 43, 90, 0.7);
    color: white;
    cursor: pointer;
    padding: 15px;
    border-radius: 100%;
    transition: background-color 0.3s ease;
    font-size: 40px; /* Adjust the size as needed */
}

#scrollTopBtn:hover {
    background-color: rgba(17, 43, 90, 0.9);
}

/* Responsive adjustments */
@media screen and (max-width: 768px) {
    #scrollTopBtn {
        bottom: 20px;
        right: 60px;
        padding: 10px; /* Adjust padding for smaller screens */
        font-size: 30px; /* Adjust font size for smaller screens */
    }
}



/* Responsive Styles */
@media screen and (max-width: 768px) {
    #scrollTopBtn {
        font-size: 30px;
        bottom: 10px;
        right: 10px;
        padding: 10px;
    }
}

@media (width > 576px) {
  .service__card {
    flex-direction: row;
  }

  .service__card img {
    max-width: 200px;
  }

  .offer__grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .offer__header {
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
  }
  .offer__grid {
    grid-template-columns: repeat(3, 1fr);
  }
}

.service__grid {
  margin-top: 4rem;
  display: grid;
  gap: 1rem;
}

.service__card {
  padding: 1rem;
  display: flex;
  gap: 1rem;
  flex-direction: column;
  border-radius: 2px;
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.1);
  transition: 0.3s;
}

.service__card:hover {
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
}

.service__card img {
  max-width: 300px;
  margin: auto;
  border-radius: 2px;
}

.service__card > div {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.service__card h4 {
  margin-bottom: 0.5rem;
  font-size: 1.2rem;
  font-weight: 800;
  color: var(--text-dark);
}

.service__card p {
  margin-bottom: 0.5rem;
  color: var(--text-light);
}

.service__btn {
  text-align: right;
}

.offer__header {
  display: flex;
  gap: 2rem;
  flex-direction: column;
}

.offer__header a {
  color: var(--primary-color);
  transition: 0.3s;
}

.offer__header a:hover {
  color: var(--primary-color-dark);
}

.offer__grid {
  margin-top: 4rem;
  display: grid;
  gap: 1rem;
}

.offer__card {
  padding: 1rem;
  border-radius: 2px;
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.1);
  transition: 0.3s;
}
/*.activity__item {
  flex-basis: 30%; 
  margin-right: 10px; 
}*/

.offer__card:hover {
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
}

.offer__card img {
  margin-bottom: 1rem;
  border-radius: 2px;
}

.offer__card h4 {
  margin-bottom: 0.5rem;
  font-size: 1.2rem;
  font-weight: 800;
  color: var(--text-dark);
}

.offer__card p {
  margin-bottom: 1rem;
  color: var(--text-light);
}

.offer__card > div {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.offer__card span {
  font-size: 1.2rem;
  font-weight: 600;
  color: var(--primary-color);
}
/* Add custom CSS styles for table */
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529; /* Text color */
    overflow-x: auto; /* Allow horizontal scrolling */
}

.table th,
.table td {
    padding: 0.75rem;
    vertical-align: top;
    border-top: 1px solid #007aff; /* Table border color */
}

.table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #007aff; /* Table header border color */
    background-color: #007aff;
    color: #fff;
}

.table tbody + tbody {
    border-top: 2px solid #007aff; /* Table body border color */
}

.table-hover tbody tr:hover {
    background-color: #f8f9fa; /* Hover background color */
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 0, 0.05); /* Alternate row background color */
}

.table-bordered {
    border: 1px solid #dee2e6; /* Table border color */
}

.table-bordered th,
.table-bordered td {
    border: 1px solid #dee2e6; /* Table cell border color */
}

.table-bordered thead th,
.table-bordered thead td {
    border-bottom-width: 2px; /* Table header border width */
}

.table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto; /* Allow horizontal scrolling */
    -webkit-overflow-scrolling: touch;
    -ms-overflow-style: -ms-autohiding-scrollbar;
}

/* Additional styling for thead */
.thead-light {
    color: #6c757d; /* Header text color */
    background-color: #f8f9fa; /* Header background color */
    border-color: #dee2e6; /* Header border color */
}

/* Responsive Styles */
@media screen and (max-width: 768px) {
    .table-responsive {
        overflow-x: auto;
    }
}



  </style>
  <body>
    <header class="header">
      <nav>
        <div class="logo">
            <a href="#"><img src="icons/yuson1.png" alt="logo" height="70px" /></a>
          </div>
        <div class="nav__logo"><a href="#home">WebYu</a></div>
        <ul class="nav__links" id="nav-links">
          <li class="link"><a href="#home">Home</a></li>
          <li class="link"><a href="#choose">About</a></li>
          <li class="link"><a href="#service">Services</a></li>
          <li class="link"><a href="#location">Location</a></li>
          <li class="link"><a href="#blog">Activities</a></li>
          <li class="link"><a href="index_login.php">LOGIN</a></li>
        </ul>
        <div class="nav__menu__btn" id="menu-btn">
          <span><i class="ri-menu-line"></i></span>
        </div>
      </nav>
      <div class="section__container header__container" id="home">
        <h1>Barangay Yuson <br>Information Management System</h1><br><br>
        <div class="contact-box">
        <h2>Details</h2>
        <?php
              require('classes/conn.php');

              // Assuming $id_brgy_info contains the ID of the barangay information
              $id_brgy_info = 1; // Example barangay information ID

              // Query the database to fetch the content of the <p> tag associated with the barangay information ID
              $sql = "SELECT brgy, municipal, province, openhours, email, contact FROM brgy_info WHERE id_brgy_info = :id";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $id_brgy_info);
              $stmt->execute();

              $row = $stmt->fetch(PDO::FETCH_ASSOC);

              // Output the content of the <p> tag
              if ($row) {
                  $brgy = $row['brgy'];
                  $municipal = $row['municipal'];
                  $province = $row['province'];
                  $openhours = $row['openhours'];
                  $email = $row['email'];
                  $contact = $row['contact'];

                  echo "<p>";
                  echo "$brgy, $municipal, $province<br />";
                  echo "$openhours<br />";
                  echo "$email | $contact<br />";
                  echo "</p>";
              } else {
                  echo "No content found for barangay information ID $id_brgy_info";
              }
          ?>
        <hr>
      </div>
      </div>
    </header>

    <section class="section__container choose__container" id="choose">
      <div class="choose__content">
        <h2 class="section__header">Background of the Barangay</h2>
          <?php
              require('classes/conn.php');

              // Assuming $id_brgy_info contains the ID of the barangay information
              $id_brgy_info = 1; // Example barangay information ID

              // Query the database to fetch the content of the <p> tag associated with the barangay information ID
              $sql = "SELECT background FROM brgy_info WHERE id_brgy_info = :id";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $id_brgy_info);
              $stmt->execute();

              $row = $stmt->fetch(PDO::FETCH_ASSOC);

              // Output the content of the <p> tag
              if ($row) {
                  $background = $row['background'];

                  echo "<p class='section__subheader'>";
                  echo "$background<br />";
                  echo "</p>";
              } else {
                  echo "No content found for barangay information ID $id_brgy_info";
              }
          ?>
      </div>
      <div class="choose__image">
        <img src="icons/logong.jpg" alt="choose" />
      </div>
      <div class="choose__image">
        <img src="icons/yuson1.png" alt="modern" class="modern__img-1" />
      </div>
      <div class="choose__content">
        <br><h2 class="section__header">
          VISION
        </h2>
        <?php
              require('classes/conn.php');

              // Assuming $id_brgy_info contains the ID of the barangay information
              $id_brgy_info = 1; // Example barangay information ID

              // Query the database to fetch the content of the <p> tag associated with the barangay information ID
              $sql = "SELECT vision FROM brgy_info WHERE id_brgy_info = :id";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $id_brgy_info);
              $stmt->execute();

              $row = $stmt->fetch(PDO::FETCH_ASSOC);

              // Output the content of the <p> tag
              if ($row) {
                  $vision = $row['vision'];

                  echo "<p class='section__subheader'>";
                  echo "$vision<br />";
                  echo "</p>";
              } else {
                  echo "No content found for barangay information ID $id_brgy_info";
              }
          ?><br>
        <h2 class="section__header">
          MISSION
        </h2>
        <?php
              require('classes/conn.php');

              // Assuming $id_brgy_info contains the ID of the barangay information
              $id_brgy_info = 1; // Example barangay information ID

              // Query the database to fetch the content of the <p> tag associated with the barangay information ID
              $sql = "SELECT mission FROM brgy_info WHERE id_brgy_info = :id";
              $stmt = $conn->prepare($sql);
              $stmt->bindParam(':id', $id_brgy_info);
              $stmt->execute();

              $row = $stmt->fetch(PDO::FETCH_ASSOC);

              // Output the content of the <p> tag
              if ($row) {
                  $mission = $row['mission'];

                  echo "<p class='section__subheader'>";
                  echo "$mission<br />";
                  echo "</p>";
              } else {
                  echo "No content found for barangay information ID $id_brgy_info";
              }
          ?>
        </div>
    </section>

    <section class="section__container testimonial__container" id="testimonial">
      <center><h2 class="section__header">Barangay Officials</h2>
      <p class="section__description">
      A barangay councilor (Filipino: kagawad or konsehal) is an elected government official who is a member of the Sangguniang Barangay (Barangay Council) of a particular barangay. The barangay is the smallest political unit in the Philippines.
      </p></center><br>
    <div class="table-responsive">
        <table class="table table-hover text-center table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-light"> <!-- Use thead-light class for header styling -->
                <tr>
                  <th style="width: 50%;">Photo</th>
                    <th style="width: 50%;">Full Name</th>
                    <th style="width: 50%;">Position</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require('classes/conn.php');

                try {
                    // Establish database connection
                    $conn = new PDO('mysql:host=localhost;dbname=u813203284_bmis', 'u813203284_webyu', 'Webyu@2023');

                    // Set PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Prepare and execute SQL query
                    $stmt = $conn->prepare("SELECT name, position, avatar FROM tbl_officials");
                    $stmt->execute();

                    // Check if there are rows returned
                    if ($stmt->rowCount() > 0) {
                        // Fetch data and display in HTML table
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <tr>
                                <td><img src="icons/<?= $row['avatar']; ?>" alt="Avatar"></td>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['position']; ?></td>
                            </tr>
                            <?php
                        }
                    } else {
                        // Display message if no data found
                        echo '<tr><td colspan="2">No records found</td></tr>';
                    }
                } catch (PDOException $e) {
                    // Handle database errors
                    echo '<tr><td colspan="2">Error: ' . $e->getMessage() . '</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
      </div>
    </section>
  

    <section class="section__container service__container" id="service">
      <center><h2 class="section__header">Our Services</h2>
      <p class="section__description">
        Barangay services cover safety, health, social welfare, development, dispute resolution, and disaster response.
      </p></center>
      <div class="service__grid">
        <div class="service__card">
    <?php
    require('classes/conn.php');

    // Assuming $id_services contains the ID of the service
    $id_services = 1; // Example service ID

    // Query the database to fetch the filename of the image associated with the service ID
    $sql = "SELECT image_service FROM tbl_services WHERE id_services = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_services);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Output the filename of the image
    if ($row) {
        $filename = $row['image_service'];

        // Construct the <img> tag to display the image
        echo '<img src="' . $filename . '" alt="Service Image">';
    } else {
        echo "No image found for service ID $id_services";
    }
    ?>

    <div>
        <div>
            <br><h4>BUSINESS PERMIT</h4>
            <p>
            Before you can start operating your business in the Philippines, you need to secure a Mayor’s Permit or Business Permit from the Local Government Unit (LGU) where your company office is located.
            </p>
        </div>
    </div>
</div>
        <div class="service__card">
          <?php
            require('classes/conn.php');

            // Assuming $id_services contains the ID of the service
            $id_services = 1; // Example service ID

            // Query the database to fetch the filename of the image associated with the service ID
            $sql = "SELECT image_service FROM tbl_services WHERE id_services = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id_services);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Output the filename of the image
            if ($row) {
                $filename = $row['image_service'];

                // Construct the <img> tag to display the image
                echo '<img src="' . $filename . '" alt="Service Image">';
            } else {
                echo "No image found for service ID $id_services";
            }
          ?>
          <div>
            <div>
              <br><h4>TRAVEL PERMIT</h4>
              <p>
              A travel document is issued to a Filipino citizen being sent back to the Philippines or who needs to urgently travel home but is unable to fully comply with the requirements for the issuance of a regular passport.
              </p>
            </div>
            
          </div>
        </div>
        <div class="service__card">
          <?php
            require('classes/conn.php');

            // Assuming $id_services contains the ID of the service
            $id_services = 3; // Example service ID

            // Query the database to fetch the filename of the image associated with the service ID
            $sql = "SELECT image_service FROM tbl_services WHERE id_services = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id_services);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Output the filename of the image
            if ($row) {
                $filename = $row['image_service'];

                // Construct the <img> tag to display the image
                echo '<img src="' . $filename . '" alt="Service Image">';
            } else {
                echo "No image found for service ID $id_services";
            }
          ?>
          <div>
            <div>
              <br><h4>CERTIFICATE OF INDIGENCY</h4>
              <p>
              A Certificate of Indigency or a Certificate of Low Income is a document that are sometimes required by the Philippine government or a private institution as proof of an individual's financial situation.
              </p>
            </div>
            
          </div>
        </div>
        <div class="service__card">
          <?php
            require('classes/conn.php');

            // Assuming $id_services contains the ID of the service
            $id_services = 2; // Example service ID

            // Query the database to fetch the filename of the image associated with the service ID
            $sql = "SELECT image_service FROM tbl_services WHERE id_services = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id_services);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Output the filename of the image
            if ($row) {
                $filename = $row['image_service'];

                // Construct the <img> tag to display the image
                echo '<img src="' . $filename . '" alt="Service Image">';
            } else {
                echo "No image found for service ID $id_services";
            }
          ?>
          <div>
            <div>
              <br><h4>CERTIFICATE OF RESIDENCY</h4>
              <p>
              Certificate of Residency is one the Philippine government issued identification documents needed for many important business, job, or personal transactions.
              </p>
            </div>
          </div>
        </div>
        <div class="service__card">
          <?php
            require('classes/conn.php');

            // Assuming $id_services contains the ID of the service
            $id_services = 2; // Example service ID

            // Query the database to fetch the filename of the image associated with the service ID
            $sql = "SELECT image_service FROM tbl_services WHERE id_services = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id_services);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Output the filename of the image
            if ($row) {
                $filename = $row['image_service'];

                // Construct the <img> tag to display the image
                echo '<img src="' . $filename . '" alt="Service Image">';
            } else {
                echo "No image found for service ID $id_services";
            }
          ?>
          <div>
            <div>
              <br><h4>BARANGAY CLEARANCE</h4>
              <p>
              A Barangay Clearance is a document issued by the Barangay Secretary and signed by the Barangay Captain stating that you are a living at that specific place and you are of good moral character.
              </p>
            </div>
          </div>
        </div>
        <div class="service__card">
          <?php
            require('classes/conn.php');

            // Assuming $id_services contains the ID of the service
            $id_services = 2; // Example service ID

            // Query the database to fetch the filename of the image associated with the service ID
            $sql = "SELECT image_service FROM tbl_services WHERE id_services = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id_services);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Output the filename of the image
            if ($row) {
                $filename = $row['image_service'];

                // Construct the <img> tag to display the image
                echo '<img src="' . $filename . '" alt="Service Image">';
            } else {
                echo "No image found for service ID $id_services";
            }
          ?>
          <div>
            <div>
              <br><h4>PEACE AND ORDER</h4>
              <p>
              Blotter reports are important because they serve as written records of incidents and activities that occur within a police station or jurisdiction. They provide a detailed account of crimes, arrests, and other incidents.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

   
    <style>
      .service__grid {
  margin-top: 4rem;
  display: grid;
  gap: 1rem;
}

.service__card {
  padding: 1rem;
  display: flex;
  gap: 1rem;
  flex-direction: column;
  border-radius: 2px;
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.1);
  transition: 0.3s;
}

.service__card:hover {
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.2);
}

.service__card img {
  max-width: 300px;
  margin: auto;
  border-radius: 2px;
}

.service__card > div {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.service__card h4 {
  margin-bottom: 0.5rem;
  font-size: 1.2rem;
  font-weight: 800;
  color: var(--text-dark);
}

.service__card p {
  margin-bottom: 0.5rem;
  color: var(--text-light);
}

.service__btn {
  text-align: right;
}
@media (width > 576px) {
  .service__card {
    flex-direction: row;
  }

  .service__card img {
    max-width: 200px;
  }
    .service__grid {
    grid-template-columns: repeat(2, 1fr);
  }
}
    </style>

      <section class="location__container location_container" id="location">
        <center><h2 class="section__header"><br><br><br>Location</h2>
          <p>Yuson Barangay Hall</p></center>
<br>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3866.237827872654!2d120.69341562388198!3d15.6859489180609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339133c9d1b6f1cd%3A0x9280b25e2e704eac!2sBrgy.%20Hall%20of%20Yuson!5e1!3m2!1sfil!2sph!4v1715253206913!5m2!1sfil!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </section><br><br>

      <style>
.location__container {
  max-width: 100%;
  margin: auto;
  padding: 0 10%; /* Dagdag na padding sa kaliwa at kanan */
}

.location__container iframe {
  width: 100%; /* Gawing responsive ang width */
  height: 500px; /* default height */
}

/* Media Query for smaller screens */
@media screen and (max-width: 768px) {
  .location__container iframe {
    height: 300px; /* Adjust height for smaller screens */
  }
}

/* Media Query for even smaller screens */
@media screen and (max-width: 480px) {
  .location__container iframe {
    height: 350px; /* Further adjust height for very small screens */
  }
}

</style>



    <section class="section__container blog_container" id="blog">
      <h2 class="section__header">Activities of the Barangay</h2>
      <div class="offer__grid">
      <div class="offer__card">
    <?php
    require('classes/conn.php');

    // Prepare the SQL query to select the latest activity
    $stmt = $conn->prepare("SELECT name, date, image FROM tbl_activies ORDER BY date DESC LIMIT 1");

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Display the activity details
        $filename = $result['image'];
        echo '<img src="' . $filename . '" alt="Service Image">';
        echo '<h4>' . $result['name'] . '</h4>';
        echo '<p>' . $result['date'] . '</p>';
    } else {
        // Handle the case when no activity is found
        echo 'No activity found.';
    }
    ?>
</div>

<div class="offer__card">
    <?php
    // Prepare the SQL query to select the second latest activity
    $stmt = $conn->prepare("SELECT name, date, image FROM tbl_activies ORDER BY date DESC LIMIT 1 OFFSET 1");

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Display the activity details
        $filename = $result['image'];
        echo '<img src="' . $filename . '" alt="Service Image">';
        echo '<h4>' . $result['name'] . '</h4>';
        echo '<p>' . $result['date'] . '</p>';
    } else {
        // Handle the case when no activity is found
        echo 'No activity found.';
    }
    ?>
</div>

<div class="offer__card">
    <?php
    // Prepare the SQL query to select the third latest activity
    $stmt = $conn->prepare("SELECT name, date, image FROM tbl_activies ORDER BY date DESC LIMIT 1 OFFSET 2");

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Display the activity details
        $filename = $result['image'];
        echo '<img src="' . $filename . '" alt="Service Image">';
        echo '<h4>' . $result['name'] . '</h4>';
        echo '<p>' . $result['date'] . '</p>';
    } else {
        // Handle the case when no activity is found
        echo 'No activity found.';
    }
    ?>
</div>

      </div>
    </section>

    <section class="section__container blog_container" id="blog">
      <h2 class="section__header">Activities of Sangguniang Kabataan</h2>
      <div class="offer__grid">
      <div class="offer__card">
    <?php
    require('classes/conn.php');

    // Prepare the SQL query to select the latest activity
    $stmt = $conn->prepare("SELECT name, date, image FROM tbl_activies ORDER BY date DESC LIMIT 1");

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Display the activity details
        $filename = $result['image'];
        echo '<img src="' . $filename . '" alt="Service Image">';
        echo '<h4>' . $result['name'] . '</h4>';
        echo '<p>' . $result['date'] . '</p>';
    } else {
        // Handle the case when no activity is found
        echo 'No activity found.';
    }
    ?>
</div>

<div class="offer__card">
    <?php
    // Prepare the SQL query to select the second latest activity
    $stmt = $conn->prepare("SELECT name, date, image FROM tbl_activies ORDER BY date DESC LIMIT 1 OFFSET 1");

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Display the activity details
        $filename = $result['image'];
        echo '<img src="' . $filename . '" alt="Service Image">';
        echo '<h4>' . $result['name'] . '</h4>';
        echo '<p>' . $result['date'] . '</p>';
    } else {
        // Handle the case when no activity is found
        echo 'No activity found.';
    }
    ?>
</div>

<div class="offer__card">
    <?php
    // Prepare the SQL query to select the third latest activity
    $stmt = $conn->prepare("SELECT name, date, image FROM tbl_activies ORDER BY date DESC LIMIT 1 OFFSET 2");

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Display the activity details
        $filename = $result['image'];
        echo '<img src="' . $filename . '" alt="Service Image">';
        echo '<h4>' . $result['name'] . '</h4>';
        echo '<p>' . $result['date'] . '</p>';
    } else {
        // Handle the case when no activity is found
        echo 'No activity found.';
    }
    ?>
</div>

      </div>
    </section>

    <br><br><br><br><br><footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__content">
          <h4>Brgy Yuson, <br>Guimba Nueva Ecija</h4>
          <p>
          Yuson is a barangay in the municipality of Guimba, in the province of Nueva Ecija. Its population as determined by the 2020 Census was 987.
          </p>
        </div>
        <div class="footer__form">
           <ul class="footer__nav">
          <li class="footer__link"><a>skyuson1@gmail.com</a></li>
          <li class="footer__link"><a>0995-265-0331</a></li>
        </ul>
        </div>
      </div>
      <div class="section__container footer__bar">
        <div class="footer__logo">
          <h4><a>WebYu</a></h4>
          <p>Copyright © 2024 Yuson Information Management System. All rights reserved.</p>
        </div>
       
      </div>
    </footer>
    <!-- Scroll to top button -->
    <button id="scrollTopBtn" onclick="scrollToTop()">
      <i class="ri-arrow-up-s-line"></i>
    </button>


    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="main.js"></script>
  </body>
  <script>
      // Function to scroll to the top of the page
      function scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      // Show or hide the scroll to top button based on scroll position
      window.onscroll = function () {
        var scrollTopBtn = document.getElementById("scrollTopBtn");
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          scrollTopBtn.style.display = "block";
        } else {
          scrollTopBtn.style.display = "none";
        }
      };
    </script>
</html>
