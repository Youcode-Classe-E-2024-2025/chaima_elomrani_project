const addTaskBtn = document.getElementById('addTaskBtn');
const taskModal = document.getElementById('taskModal');
const close =document.getElementById('close')


addTaskBtn.addEventListener('click', function (){
    taskModal.style.display="block";
});

close.addEventListener('click',function(){
    taskModal.style.display='none';
})

