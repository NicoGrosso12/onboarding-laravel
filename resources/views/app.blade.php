<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .sidenav {
            height: 100vh;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidenav a {
            padding: 15px 25px;
            text-decoration: none;
            font-size: 16px;
            color: #333;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover, .sidenav a.active {
            background-color: #007bff;
            color: white;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
        }

        .component-container {
            display: none;
            animation: fadeIn 0.3s;
        }

        .component-container.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>
    <!-- Sidenav -->
    <div class="sidenav">
        <a href="#" class="nav-link active" data-component="employee">Employee Management</a>
        <a href="#" class="nav-link" data-component="task">Task Management</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div id="global-success-message" class="alert alert-success" style="display: none;"></div>
        <div id="employee-component" class="component-container active">
            @include('components.employee-form')
        </div>
        <div id="task-component" class="component-container">
            @include('components.task-form', ['employees' => $employees ?? []])
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const globalSuccessMessage = document.getElementById('global-success-message');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    globalSuccessMessage.style.display = 'none';
                    globalSuccessMessage.textContent = '';

                    navLinks.forEach(l => l.classList.remove('active'));
                    document.querySelectorAll('.component-container').forEach(c => c.classList.remove('active'));

                    this.classList.add('active');
                    const componentId = `${this.dataset.component}-component`;
                    document.getElementById(componentId).classList.add('active');
                });
            });
        });
    </script>
</body>
</html>
