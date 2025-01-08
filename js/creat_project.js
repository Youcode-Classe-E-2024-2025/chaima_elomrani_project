        const userMenuBtn = document.querySelector('.user-menu-btn');
        const userMenuContent = document.querySelector('.user-menu-content');
        userMenuBtn.addEventListener('click', () => {
            userMenuContent.style.display = userMenuContent.style.display === 'block' ? 'none' : 'block';
        });
        document.addEventListener('click', (event) => {
            if (!event.target.closest('.user-menu')) {
                userMenuContent.style.display = 'none';
            }
        });
        

        const projectForm = document.getElementById('projectForm');
        const addMemberBtn = document.getElementById('addMemberBtn');
        const assignMemberInput = document.getElementById('assignMember');
        const memberList = document.getElementById('memberList');
        const closeBtn = document.getElementById('closeBtn');

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
    
   