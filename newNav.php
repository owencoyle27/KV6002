
<header class="nav">
    <a href="index.php" class="logo">
        <img alt="Northumbria" src="images/Logo.png" width="200">
    </a>
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
    <ul class="menu">
      <li><a href="index.php">Dashboard</a></li>
      <li><a href="map.php">Campus Map</a></li>
      <li><a href="#">Societies</a></li>
      <li><a href="/Chat/index.php">Forum</a></li>
      <li><a href="/ChatBot/index.php">Chat Bot</a></li>
    </ul>
</header>


  <style>
    .nav {
        background-color: black;
        width: 100%;
        z-index: 3;
    }

    .nav ul {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        list-style: none;
        overflow: hidden;
        background-color: black;
        
    }

    .nav li a {
        display: block;
        padding: 20px 20px;
        border-bottom: solid 4px black;
        text-decoration: none;
        color: white;
    }

    .nav li a:hover,
    .nav .menu-btn:hover {
        border-bottom: solid 4px white;
    }

    .nav .logo {
        display: block;
        float: left;
        font-size: 2em;
        padding: 10px 20px;
        text-decoration: none;
    }

    /* menu */

    .nav .menu {
        clear: both;
        max-height: 0;
        transition: max-height .2s ease-out;
    }

    /* menu icon */

    .nav .menu-icon {
        cursor: pointer;
        display: inline-block;
        float: right;
        user-select: none;
        padding: 35px 20px;
        position: relative;

    }

    /* spining mobile button */

    .nav .menu-icon .navicon {
        background: white;
        display: block;
        height: 2px;
        position: relative;
        width: 20px;
    }

    .nav .menu-icon .navicon:before,
    .nav .menu-icon .navicon:after {
        background: white;
        
        display: block;
        height: 100%;
        position: absolute;
        width: 100%;
        content: '';
    }

    .nav .menu-icon .navicon:before {
        top: 5px;
    }

    .nav .menu-icon .navicon:after {
        top: -5px;
    }

    .nav .menu-btn {
        display: none;
    }

    .nav .menu-btn:checked ~ .menu {
        max-height: 360px;
    }

    .nav .menu-btn:checked ~ .menu-icon .navicon {
        background: transparent;
    }

    .nav .menu-btn:checked ~ .menu-icon .navicon:before {
        transform: rotate(-45deg);
    }

    .nav .menu-btn:checked ~ .menu-icon .navicon:after {
        transform: rotate(45deg);
    }

    .nav .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:before,
    .nav .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:after {
        top: 0;
    }

    @media (max-width: 800px) {
        .nav li {
            width: 100%;
        }
    }


    /* stlyes for  desktop nav*/
    @media (min-width: 800px) {

        .nav {
            height: 100px;
        }

        .nav li {
            float: left;
            height: 100%;
            display: flex;
        }

        .nav li a {
            padding: 20px 30px;
            /*height: 100%;*/
            align-self: flex-end;
        }

        .nav .menu {
            clear: none;
            float: right;
            max-height: none;
            height: 100%;
            margin-right: 50px;
        }

        .nav .menu-icon {
            display: none;
        }

    }

  </style>