<div class="form-container">
    <h2 class="mb-4">Task Management</h2>
    <form id="taskForm" action="{{ route('tasks') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="action">Action</label>
            <select name="action" id="action" class="form-control" required
                    onchange="document.getElementById('taskSelectGroup').style.display = this.value === 'update' ? 'block' : 'none'">
                <option value="create">Create New Task</option>
                <option value="update">Update Task</option>
            </select>
        </div>

        <div id="taskSelectGroup" class="form-group" style="display: none;">
            <label for="task_id">Select Task</label>
            <select name="task_id" id="task_id" class="form-control" onchange="populateTaskFields(this.value)">
                <option value="">Select Task</option>
            </select>
        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="pending">Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <div class="form-group">
            <label for="assigned_to">Assign to Employee</label>
            <select name="employee_id" class="form-control" required onclick="loadEmployees(this)">
                <option value="">Select Employee</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    let employeesLoaded = false;
    let tasksLoaded = false;

    function loadEmployees(select) {
    return new Promise((resolve, reject) => {
        if (employeesLoaded) {
            resolve();
            return;
        }

        select.innerHTML = '<option value="">Select Employee</option>';

        fetch('/employees', {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(response => {
                response.data.forEach(employee => {
                    const option = document.createElement('option');
                    option.value = employee.id;
                    option.textContent = employee.name;
                    select.appendChild(option);
                });
                employeesLoaded = true;
                resolve();
            })
            .catch(error => {
                console.error('Error loading employees:', error);
                reject(error);
            });
    });
}

    function loadTasks(select) {
        if (tasksLoaded) return;

        fetch('/tasks', {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(response => {
                const taskSelect = document.getElementById('task_id');
                taskSelect.innerHTML = '<option value="">Select Task</option>'; // Reset existing options

                response.data.forEach(task => {
                    const option = document.createElement('option');
                    option.value = task.id;
                    option.textContent = `Task ${task.id}: ${task.title}`;
                    taskSelect.appendChild(option);
                });
                tasksLoaded = true;
            })
            .catch(error => console.error('Error loading tasks:', error));
    }

    function populateTaskFields(taskId) {
        if (!taskId) {
            document.querySelector('input[name="title"]').value = '';
            document.querySelector('textarea[name="description"]').value = '';
            document.querySelector('select[name="status"]').value = 'pending';
            document.querySelector('select[name="employee_id"]').value = '';
            return;
        }

        fetch(`/tasks/${taskId}`, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(async response => {
                const task = response.data;
                document.querySelector('input[name="title"]').value = task.title;
                document.querySelector('textarea[name="description"]').value = task.description;
                document.querySelector('select[name="status"]').value = task.status;

                const employeeSelect = document.querySelector('select[name="employee_id"]');
                await loadEmployees(employeeSelect);
                employeeSelect.value = task.employee_id;
            })
            .catch(error => console.error('Error loading task details:', error));
    }

    document.getElementById('action').addEventListener('change', function() {
        if (this.value === 'update') {
            document.getElementById('taskSelectGroup').style.display = 'block';
            loadTasks(this);
        } else {
            document.getElementById('taskSelectGroup').style.display = 'none';
            populateTaskFields('');
        }
    });

    document.getElementById('taskForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const action = formData.get('action');

        if (action === 'update') {
            const taskId = formData.get('task_id');
            formData.append('id', taskId);
        }
        formData.delete('task_id');

        fetch('{{ route('tasks') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => response.json())
            .then(data => {
                // Switch to task tab
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                document.querySelectorAll('.component-container').forEach(c => c.classList.remove('active'));

                document.querySelector('[data-component="task"]').classList.add('active');
                document.getElementById('task-component').classList.add('active');

                // Show success message in global container
                const globalSuccessMessage = document.getElementById('global-success-message');
                globalSuccessMessage.textContent = action === 'update' ? 'Task updated successfully' : 'Task created successfully';
                globalSuccessMessage.style.display = 'block';

                this.reset();
                document.getElementById('taskSelectGroup').style.display = 'none';
                document.getElementById('action').value = 'create';
                const employeeSelect = document.querySelector('select[name="employee_id"]');
                employeeSelect.selectedIndex = 0;
                employeesLoaded = false;
                tasksLoaded = false;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>
