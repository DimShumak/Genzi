function clearFilter() {
    document.getElementById('ageFilterForm').reset();
    const params = new URLSearchParams(window.location.search);
    for (const key of params.keys()) {
            if (key.startsWith('AGE')) {
                params.delete(key);
            }
        }
    const newUrl = window.location.pathname + '?' + params.toString();
    window.location.href = newUrl;
}
function toggleFilter(filterName, button) {
    const isActive = button.classList.toggle('active'); 
    const urlParams = new URLSearchParams(window.location.search);
    if (isActive) {
        urlParams.set(filterName, 'Y'); 
    } else {
        urlParams.delete(filterName); 
    }
    window.location.search = urlParams.toString();
}

    const filterForm = document.getElementById('ageFilterForm');
   if (filterForm) {
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const params = new URLSearchParams(window.location.search);
        
        for (const key of params.keys()) {
            if (key.startsWith('AGE')) {
                params.delete(key);
            }
        }

        for (let [key, value] of formData.entries()) {
            if (key !== 'apply_filter') {
                params.append(key, value);
            }
        }

        const newUrl = window.location.pathname + '?' + params.toString();
        window.location.href = newUrl;
    });
}

     
  
