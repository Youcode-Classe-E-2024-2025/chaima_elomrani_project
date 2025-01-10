document.addEventListener('DOMContentLoaded', function () {
    const closeBtn = document.getElementById('close-btn');
    const editForm = document.getElementById('edit-form');
    const editButtons = document.querySelectorAll('.update-btn');


    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const projectCard = this.closest('.project-card');

            const projectId = projectCard.querySelector('input[name="project_id"]').value;
            const projectName = projectCard.querySelector('input[name="project_name"]').value;
            const projectDescription = projectCard.querySelector('input[name="project_description"]').value;
            const projectDueDate = projectCard.querySelector('input[name="project_due_date"]').value;

            document.getElementById('edit-project-id').value = projectId;
            document.getElementById('edit-project-name').value = projectName;
            document.getElementById('edit-project-description').value = projectDescription;
            document.getElementById('edit-due-date').value = projectDueDate;

            editForm.style.display = 'block';
        });
    });

    // Close form when close button is clicked
    closeBtn.addEventListener('click', () => {
        editForm.style.display = 'none';
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const assignProjectsBtn = document.getElementById('assignProjectsBtn');
    const assignProjectsModal = document.getElementById('assignProjectsModal');
    const closeModal = document.querySelector('.close-modal');

    // Open modal
    assignProjectsBtn.addEventListener('click', function () {
        assignProjectsModal.style.display = 'block';
    });

    // Close modal
    closeModal.addEventListener('click', function () {
        assignProjectsModal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function (event) {
        if (event.target === assignProjectsModal) {
            assignProjectsModal.style.display = 'none';
        }
    });

    const addMemberBtn = document.getElementById('add-member-btn');
    const memberInput = document.getElementById('assign-member');
    const memberList = document.getElementById('member-list');

    // Add member to list
    addMemberBtn.addEventListener('click', function () {
        const memberEmail = memberInput.value.trim();
        if (memberEmail) {
            const li = document.createElement('li');
            li.textContent = memberEmail;
            memberList.appendChild(li);
            memberInput.value = '';
        }
    });

    // Handle form submission
    const assignProjectForm = document.getElementById('assignProjectForm');
    assignProjectForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        try {
            const projectId = document.getElementById('projectsSelect').value;
            const memberElements = document.querySelectorAll('#member-list li');
            const members = Array.from(memberElements).map(li => li.textContent.trim());

            if (!projectId) {
                alert('Please select a project');
                return;
            }

            if (members.length === 0) {
                alert('Please add at least one member');
                return;
            }

            console.log('Sending data:', { projectId, members }); // Debug log

            const response = await fetch('index.php?action=assign_members', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    projectId: projectId,
                    members: members
                })
            });

            // Check if response is OK
            if (!response.ok) {
                const errorText = await response.text();
                console.error('Server error:', errorText);
                throw new Error(`HTTP error! status: ${response.status}, message: ${errorText}`);
            }

            // Try to parse JSON
            const data = await response.json();

            if (data.success) {
                alert('Members assigned successfully!');
                assignProjectsModal.style.display = 'none';
                memberList.innerHTML = '';
                window.location.reload();
            } else {
                // Handle unsuccessful response
                throw new Error(data.message || 'Unknown error occurred');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error assigning members: ' + error.message);
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const assignTasksModal = document.getElementById('assignTasksModal');
    const closeModal = assignTasksModal.querySelector('.close-modal');
    const addMemberBtn = document.getElementById('add-member-btn');
    const memberInput = document.getElementById('assign-member');
    const memberList = document.getElementById('member-list');
    const assignTaskForm = document.getElementById('assignTaskForm');
    const projectDetailsBtns = document.querySelectorAll('.project-details-btn');


    // assignTasksModal.style.display='none';
    // Open modal for each project's "Add Members" button
    projectDetailsBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default link behavior
            assignTasksModal.style.display = 'block';
        });
    });

    // Close modal
    closeModal.addEventListener('click', function () {
        assignTasksModal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', function (event) {
        if (event.target === assignTasksModal) {
            assignTasksModal.style.display = 'none';
        }
    });

    // Add member to list
    addMemberBtn.addEventListener('click', function () {
        const memberEmail = memberInput.value.trim();
        if (memberEmail && /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(memberEmail)) {
            const li = document.createElement('li');
            li.innerHTML = `
                ${memberEmail} 
                <span class="remove-member" style="cursor: pointer; color: red; margin-left: 10px;">&times;</span>
            `;
            
            // Add remove functionality to the new member
            li.querySelector('.remove-member').addEventListener('click', function() {
                li.remove();
            });

            memberList.appendChild(li);
            memberInput.value = '';
        } else {
            alert('Please enter a valid email address');
        }
    });

    // Handle form submission
    assignTaskForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        try {
            // Get the current project's ID from the clicked "Add Members" button
            const currentProjectBtn = document.querySelector('.project-details-btn:focus');
            const projectCard = currentProjectBtn.closest('.project-card');
            const projectId = projectCard.querySelector('input[name="project_id"]').value;

            const memberElements = document.querySelectorAll('#member-list li');
            const members = Array.from(memberElements).map(li => 
                li.textContent.trim().replace('×', '').trim()
            );

            if (members.length === 0) {
                alert('Please add at least one member');
                return;
            }

            console.log('Sending data:', { projectId, members }); // Debug log

            const response = await fetch('index.php?action=assign_members', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    projectId: projectId,
                    members: members
                })
            });

            // Check if response is OK
            if (!response.ok) {
                const errorText = await response.text();
                console.error('Server error:', errorText);
                throw new Error(`HTTP error! status: ${response.status}, message: ${errorText}`);
            }

            // Try to parse JSON
            const data = await response.json();

            if (data.success) {
                alert('Members assigned successfully!');
                assignTasksModal.style.display = 'none';
                memberList.innerHTML = '';
                window.location.reload();
            } else {
                // Handle unsuccessful response
                throw new Error(data.message || 'Unknown error occurred');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error assigning members: ' + error.message);
        }
    });
});