{-- Converted from admin/pengaturan.html to Blade --}
<!-- Put this file in resources/views/admin/pengaturan.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Pengaturan — Perpustakaan SMAN 1 Hamparan Perak</title>

  <!-- Font -->
  <link  rel="stylesheet">

  <!-- Icons & CSS -->
  <link  rel="stylesheet" />
  <link  rel="stylesheet" />

  <style>
    :root {
      --primary: #001B5A99;   /* translucent navy */
      --secondary: #001B5A5C; /* darker navy */
      --bg: #FFFFFF;
      --muted: #6b7280;
      --card-shadow: 0 10px 25px rgba(3, 19, 45, 0.06);
      --glass: rgba(255, 255, 255, 0.55);
    }

    body {
      background: var(--bg);
      font-family: 'Inter';
    }

    /* =============================
          SIDEBAR
    ============================== */
    .sidebar {
      background: linear-gradient(180deg, var(--secondary), var(--primary));
    }

    /* =============================
          GLASS CARD MODERN
    ============================== */
    .card-modern {
      padding: 28px;
      border-radius: 18px;
      margin-bottom: 28px;
      background: var(--glass);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      border: 1px solid rgba(255, 255, 255, 0.35);
      box-shadow: var(--card-shadow);
      animation: fadeIn .55s ease-out;
    }

    .card-modern h3 {
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 18px;
      color: var(--primary);
    }

    /* INPUT MODERN */
    .form-control {
      background: rgba(255, 255, 255, 0.75);
      border-radius: 12px;
      border: 1px solid rgba(0, 0, 0, 0.08);
      padding: 12px 14px;
      transition: 0.25s ease;
    }

    .form-control:focus {
      background: #fff;
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(0, 27, 90, 0.15);
    }

    /* BUTTON */
    .btn-primary {
      background: var(--primary);
      border-radius: 12px;
      padding: 10px 22px;
      border: none;
      transition: 0.25s;
    }

    .btn-primary:hover {
      background: #001b5acc;
      transform: translateY(-2px);
    }

    /* ANIMATION */
    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body id="page-top">

  

  <!-- WRAPPER -->
  <div id="wrapper">

    <!-- SIDEBAR -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

      <a class="sidebar-brand d-flex align-items-center justify-content-center" >
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-2">Perpustakaan</div>
      </a>

      <hr class="sidebar-divider">

      <li class="nav-item"><a class="nav-link" ><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>

      <hr class="sidebar-divider">
      <div class="sidebar-heading">Data Buku</div>
      <li class="nav-item"><a class="nav-link" ><i class="fas fa-file"></i> Buku Akademik</a></li>
      <li class="nav-item"><a class="nav-link" ><i class="fas fa-book"></i> Buku Non-Akademik</a></li>

      <hr class="sidebar-divider">
      <div class="sidebar-heading">Data Users</div>
      <li class="nav-item"><a class="nav-link" ><i class="fas fa-user"></i> Users</a></li>
      <li class="nav-item"><a class="nav-link" ><i class="fas fa-chalkboard-teacher"></i> Petugas</a></li>

      <hr class="sidebar-divider">
      <div class="sidebar-heading">Transaksi</div>
      <li class="nav-item"><a class="nav-link" ><i class="fas fa-hand-holding"></i> Peminjaman</a></li>
      <li class="nav-item"><a class="nav-link" ><i class="fas fa-undo"></i> Pengembalian</a></li>

      <hr class="sidebar-divider">
      <div class="sidebar-heading">Pengaturan</div>
      <li class="nav-item active"><a class="nav-link" ><i class="fas fa-cog"></i> Pengaturan</a></li>

      <hr class="sidebar-divider">
      <li class="nav-item"><a class="nav-link" ><i class="fas fa-sign-out-alt"></i>Logout</a></li>

    </ul>
    <!-- END SIDEBAR -->

    <!-- CONTENT WRAPPER -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- MAIN CONTENT -->
      <div id="content">

        <!-- TOPBAR -->        
<nav class="navbar navbar-expand navbar-light topbar mb-4 shadow">
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" data-toggle="dropdown">
        <span class="mr-2 text-gray-600 small">Admin</span>
        <img class="img-profile rounded-circle" >
      </a>

      <div class="dropdown-menu dropdown-menu-right shadow">
        <a class="dropdown-item">
          <i class="fas fa-user fa-sm fa-fw mr-2"></i> Profile
        </a>
        <a class="dropdown-item" >
          <i class="fas fa-cogs fa-sm fa-fw mr-2"></i> Pengaturan
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" >
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
        
        <!-- END TOPBAR -->

        <!-- PAGE CONTENT -->
        <div class="container-fluid fade-in">

          <!-- Page Heading -->
                    <h1 class="h3 mb-4 font-weight-bold text-gray-800">Pengaturan</h1>
          <!-- PROFIL SEKOLAH -->
          <div class="card-modern">
            <h3>Profil Sekolah</h3>

            <label>Nama Sekolah</label>
            <input type="text" class="form-control mb-2" value="SMA Negeri 1 Hamparan Perak">

            <label>Alamat</label>
            <input type="text" class="form-control mb-2" value="Hamparan Perak, Deli Serdang">

            <label>Email</label>
            <input type="email" class="form-control mb-2" value="perpustakaan@sman1hp.sch.id">

            <label>No Telepon</label>
            <input type="text" class="form-control mb-2" value="08xxxxxxx">

            <button class="btn btn-primary mt-2">Simpan</button>
          </div>

          <!-- PROFIL ADMIN -->
          <div class="card-modern">
            <h3>Profil Admin</h3>

            <label>Nama Admin</label>
            <input type="text" class="form-control mb-2">

            <label>Email Login</label>
            <input type="email" class="form-control mb-2">

            <label>Password Baru</label>
            <input type="password" class="form-control mb-2" placeholder="••••••••">

            <button class="btn btn-primary mt-2">Update</button>
          </div>

          <!-- WEBSITE -->
          <div class="card-modern">
            <h3>Pengaturan Website</h3>

            <label>Nama Website</label>
            <input type="text" class="form-control mb-2" value="Perpustakaan SMAN 1 HP">

            <label>Logo Website</label>
            <input type="file" class="form-control mb-3">

            <label>Mode Akses Pengunjung</label>
            <select class="form-control">
              <option>Publik</option>
              <option>Login Wajib</option>
            </select>
          </div>

          <!-- SISTEM -->
          <div class="card-modern">
            <h3>Pengaturan Sistem</h3>

            <label>Lama Peminjaman (hari)</label>
            <input type="number" class="form-control mb-2" value="7">

            <label>Denda per Hari (Rp)</label>
            <input type="number" class="form-control mb-2" value="1000">

            <label>Batas Maksimal Peminjaman</label>
            <input type="number" class="form-control mb-2" value="3">
          </div>

          <!-- BACKUP -->
          <div class="card-modern">
            <h3>Backup & Restore</h3>

            <button class="btn btn-primary mb-3">Backup Database</button>
            <input type="file" class="form-control">
          </div>

        </div>

      </div>

      <footer class="sticky-footer bg-white">
        <div class="text-center py-3">Perpustakaan SMAN 1 Hamparan Perak</div>
      </footer>

    </div>

  </div>

  <!-- Scripts -->
  <script ></script>
  <script ></script>
  <script ></script>

</body>

</html>
