<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staha – The Maritime Career Network</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-dark: #0f172a;
            --primary-light: #1e293b;
            --accent: #38bdf8;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            scroll-behavior: smooth;
        }

        h1,
        h2,
        h3,
        .brand {
            font-family: 'Outfit', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="min-h-screen">
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    $auth_pages = ['login.php', 'register.php'];
    ?>

    <!-- Navbar -->
    <?php if (!in_array($current_page, $auth_pages)): ?>
        <nav class="glass sticky top-0 z-50 py-4 px-6 md:px-12 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fa-solid fa-anchor text-3xl text-sky-500"></i>
                <span
                    class="text-2xl font-bold brand bg-clip-text text-transparent bg-gradient-to-r from-sky-600 to-indigo-600">Staha</span>
            </div>

            <div class="hidden md:flex space-x-8 text-slate-600 font-medium">
                <a href="index.php#hero" class="hover:text-sky-500 transition">Home</a>
                <a href="index.php#about" class="hover:text-sky-500 transition">About</a>
                <a href="index.php#features" class="hover:text-sky-500 transition">Features</a>
                <a href="index.php#analytics" class="hover:text-sky-500 transition">Analytics</a>
                <a href="jobs.php" class="hover:text-sky-500 transition">Job Board</a>
            </div>

            <div class="flex items-center space-x-4">
                <a href="login.php" class="text-slate-600 hover:text-sky-500 font-medium px-4 py-2">Login</a>
                <a href="register.php"
                    class="bg-sky-500 hover:bg-sky-600 text-white font-semibold px-6 py-2 rounded-full transition shadow-lg shadow-sky-500/30">Join
                    Now</a>
            </div>
        </nav>
    <?php endif; ?>