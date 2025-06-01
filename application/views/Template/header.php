<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $judul ?></title>
    <!-- CSS BOOTSRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS DATATABLE -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- JS CHART -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Datatables -->
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <!-- Font Aweseom -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            transition-duration: 1.5s;
            transition-timing-function: ease, ease-in-out;
        }



        .sidebar {
            height: 100vh;
            position: fixed;
            width: 240px;
            background-color: #343a40;
            color: white;
            overflow-y: auto;
            padding-top: 1rem;
        }

        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }

        .sidebar ul li {
            padding: 0;
        }

        .sidebar ul li a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 12px 25px;
            cursor: pointer;
        }

        .sidebar ul li a:hover,
        .sidebar ul li a.active {
            background-color: #495057;
            color: #fff;
        }

        .sidebar ul li ul.submenu {
            padding-left: 0;
            list-style: none;
            background-color: #3e444a;
        }

        .sidebar ul li ul.submenu li a {
            padding-left: 45px;
            font-size: 0.95rem;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 240px;
            padding: 20px;
        }

        .card-icon {
            font-size: 2rem;
            color: #fff;
            padding: 20px;
            border-radius: 0.75rem;
        }

        .card-clickable {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .card-clickable:hover {
            transform: translateY(-7px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15);
        }

        .bg-sales {
            background-color: #4e73df;
        }

        .bg-products {
            background-color: #1cc88a;
        }

        .bg-users {
            background-color: #36b9cc;
        }

        .bg-stock {
            background-color: #f6c23e;
        }

        .bg-ijosagemuda {
            background-color: #90D1CA;
        }

        .btn-success {
            background-color: #38c172;
            border-color: #38c172;
        }

        .btn-success:hover {
            transition-duration: 0.3s;
            background-color: #2fa360;
            border-color: #2fa360;
        }
    </style>
</head>

<body>