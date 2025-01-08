const addTaskBtn = document.getElementById('addTaskBtn');
const taskModal = document.getElementById('taskModal');
const close =document.getElementById('close')


addTaskBtn.addEventListener('click', function (){
    taskModal.style.display="block";
});

close.addEventListener('click',function(){
    taskModal.style.display='none';
})



// update **********

document.addEventListener('DOMContentLoaded', function() {
    const updateButtons = document.querySelectorAll('.update-btn');
    const updateModal = document.getElementById('updateTaskModal');
    const closeBtn = updateModal.querySelector('.close-btn');
    
    function populateUpdateForm(taskCard) {
        const taskId = taskCard.querySelector('input[name="project_id"]').value;
        const taskName = taskCard.querySelector('h4').textContent;
        const taskDescription = taskCard.querySelector('p').textContent;
        const taskProject = taskCard.querySelector('.task-project').textContent;
        const taskStartDate = taskCard.querySelector('.task-due-date').textContent.trim();
        
        document.getElementById('update-task-id').value = taskId;
        document.getElementById('update-task-name').value = taskName;
        document.getElementById('update-task-description').value = taskDescription;
        
        const projectSelect = document.getElementById('update-task-project');
      
        
        document.getElementById('update-task-start-date').value = taskStartDate;
    }
    
    updateButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const taskCard = this.closest('.task-card');
            populateUpdateForm(taskCard);
            updateModal.style.display = 'block';
        });
    });
    
    closeBtn.addEventListener('click', function() {
        updateModal.style.display = 'none';
    });
    
    window.addEventListener('click', function(e) {
        if (e.target === updateModal) {
            updateModal.style.display = 'none';
        }
    });
});
