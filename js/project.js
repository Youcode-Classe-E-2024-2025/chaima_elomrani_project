
// User menu toggle
const userMenuBtn = document.querySelector('.user-menu-btn');
const userMenuContent = document.querySelector('.user-menu-content');

userMenuBtn.addEventListener('click', () => {
    userMenuContent.style.display = userMenuContent.style.display === 'block' ? 'none' : 'block';
});

// Close user menu when clicking outside
document.addEventListener('click', (event) => {
    if (!event.target.closest('.user-menu')) {
        userMenuContent.style.display = 'none';
    }
});

// Animate project cards on scroll
const projectCards = document.querySelectorAll('.project-card');

const animateOnScroll = (entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = 1;
            entry.target.style.transform = 'translateY(0)';
        }
    });
};

const options = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
};

const observer = new IntersectionObserver(animateOnScroll, options);

projectCards.forEach(card => {
    card.style.opacity = 0;
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(card);
});













// form update 
const projectForm = document.getElementById('edit-form');
const addMemberBtn = document.getElementById('add-member-btn');
const assignMemberInput = document.getElementById('assign-member');
const memberList = document.getElementById('member-list');
const closeBtn = document.getElementById('close-btn');

let members = [];

function addMember(name) {
    const memberId = Date.now();
    const member = { id: memberId, name: name };
    members.push(member);
    renderMemberList();
    assignMemberInput.value = '';
}

function removeMember(id) {
    members = members.filter(member => member.id !== id);
    renderMemberList();
}

function renderMemberList() {
    memberList.innerHTML = '';
    members.forEach(member => {
        const li = document.createElement('li');
        li.className = 'member-item';
        li.innerHTML = `
            <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(member.name)}&background=random" alt="${member.name}">
            <span>${member.name}</span>
            <i class="fas fa-times remove-member" data-id="${member.id}"></i>
        `;
        memberList.appendChild(li);
    });
}

addMemberBtn.addEventListener('click', () => {
    const memberName = assignMemberInput.value.trim();
    if (memberName) {
        addMember(memberName);
    }
});

memberList.addEventListener('click', (e) => {
    if (e.target.classList.contains('remove-member')) {
        const memberId = parseInt(e.target.getAttribute('data-id'));
        removeMember(memberId);
    }
});

projectForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(projectForm);
    const projectData = Object.fromEntries(formData.entries());
    projectData.members = members;

    console.log('Project Data:', projectData);
    alert('Project saved successfully!');
});

closeBtn.addEventListener('click', () => {
    if (confirm('Are you sure you want to close? All unsaved changes will be lost.')) {
        console.log('Closing form...');
    }
});


document.addEventListener('DOMContentLoaded' , () => {
    const editForm =document.querySelector('#edit-form');
        const editbtns =document.querySelectorAll('#editbtn');

        editbtns.forEach(btn => {
            btn.addEventListener('click',()=>{                
                editForm.style.display='block';
            })
            
        });
})





