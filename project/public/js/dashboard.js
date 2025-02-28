

const create = document.getElementById('modelCreate');

function closeModal() {
    create.classList.add('hidden')
}

function openModel() {
    create.classList.remove('hidden')
}

function openPage(index) {
    const pages = Array.from(document.getElementsByClassName('page'));
    pages.map(item => {
        item.classList.add('hidden')
    });
    pages[index].classList.remove('hidden');
}

function selectResponse(index) {
    document.getElementById('correct' + (index + 1)).checked = true;
    
    // Highlight selected response
    const containers = document.querySelectorAll('.response-container');
    containers.forEach((container, i) => {
        if (i === index) {
            container.classList.remove('bg-gray-50', 'hover:bg-gray-100');
            container.classList.add('bg-green-50', 'border', 'border-green-200');
        } else {
            container.classList.remove('bg-green-50', 'border', 'border-green-200');
            container.classList.add('bg-gray-50', 'hover:bg-gray-100');
        }
    });
}

function resetForm() {
    document.getElementById('questionForm').reset();
    document.querySelectorAll('.response-container').forEach(container => {
        container.classList.remove('bg-green-50', 'border', 'border-green-200');
        container.classList.add('bg-gray-50', 'hover:bg-gray-100');
    });
}


