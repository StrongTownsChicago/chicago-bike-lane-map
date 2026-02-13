  <!-- Navbar -->
  <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <!-- navbar-expand-md means the navbar should expand to fill if screen is larger than medium-sized. Otherwise, put the buttons in a hamburger. -->
    <div class="container-xxl">
      <!-- Main title with link -->

      <!-- Toggle button for mobile nav -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav" aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Aria things are for screen readers -->

      <!-- Here are all of the links that can be collapsed into a hamburger menu -->
      <div class="collapse navbar-collapse justify-content-center align-center" id="main-nav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="about.php" class="nav-link">About</a>
          </li>
          <li>
            <a href="index.php" class="nav-link">Map</a>
          </li>
          <li>
            <a href="contact.php" class="nav-link">Contact</a>
          </li>
          <li>
            <a href="data/paths.json" class="nav-link">Data</a>
          </li>
          <li>
            <a href="https://github.com/strongtownschicago/chicago-bike-lane-map" class="nav-link">Github</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
