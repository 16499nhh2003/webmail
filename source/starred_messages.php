<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UserInterfaceDesign</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .tr {
              margin: 5px;
              padding: 5px;
              border: 1px solid black;
            }
        </style>
        <!-- <script>
        let submitButton = document.querySelector('.btn.btn-success');
        // Thêm sự kiện onclick cho nút submit
        submitButton.onclick = function() {
          // Lặp qua tất cả các ô đánh dấu
          let checkboxes = document.querySelectorAll('input[type="checkbox"]');
          let checkedIds = [];
          for (let i = 0; i < checkboxes.length; i++) {
            // Nếu ô đó được tích và có id là "star", thêm id của header tương ứng vào mảng checkedIds
            if (checkboxes[i].checked && checkboxes[i].id === 'star') {
              checkedIds.push(checkboxes[i].value);
            }
          }
        };
        </script> -->
      </head>
<body onload="setUp()">
  <div class="container">
      <nav class="navbar navbar-expand-sm|lg|xl|xs bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">WEBMAIL</a>
        <ul class="nav justify-content-center">
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
        </ul>
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
      
        <!-- Links -->
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sign Up</a>
          </li>
          
          <!-- Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
              Chat
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Compose mail</a>
              <a class="dropdown-item" href="#">Sent</a>
              <a class="dropdown-item" id="starred-nav" href="#">Starred</a>
              <a class="dropdown-item" href="#">Draff</a>
              <a class="dropdown-item" href="#">More</a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="container col-lg-10 sm-5 xs-3">
        <table style="border:1px; width:100%;">
          <thead>
          <tr>
            <th>Check</th>
            <th>Mail Header</th>
          </tr>
        </thead>
          <tbody>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="1"> Mail Header 1</td>
          </tr>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="2"> Mail Header 2</td>
          </tr>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="3"> Mail Header 3</td>
          </tr>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="4"> Mail Header 4</td>
          </tr>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="5"> Mail Header 5</td>
          </tr>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="6"> Mail Header 6</td>
          </tr>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="7"> Mail Header 7</td>
          </tr>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="8"> Mail Header 8</td>
          </tr>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="9"> Mail Header 9</td>
          </tr>
          <tr class="tr">
            <td><input type="checkbox" id="star" name="important_mes" value="10"> Mail Header 10</td>
          </tr>
        </tbody>
        </table>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    <script>
      function setUp() {
        let submitButton = document.querySelector('.btn.btn-success');
        submitButton.onclick = function() {
          let checkedIds = [];
          let checkboxes = document.getElementsByName('important_mes');
          for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
              checkedIds.push(checkboxes[i].value);
            }
          }
          console.log(checkedIds);
        }
      }
    </script>
  </div>
</body>
</html>