/*function clearFilter(code) {
    const params = new URLSearchParams(window.location.search);
    for (const key of params.keys()) {
            if (key.startsWith(code)) {
                params.delete(key);
            }
        }
    const newUrl = window.location.pathname + '?' + params.toString();
    window.location.href = newUrl;
}

function clearFilterNotList(code) {
    const params = new URLSearchParams(window.location.search);
    const codeFrom = code+'_FROM';
    const codeUP = code+'_UP';
    const keysToDelete = [];
    for (const key of params.keys()) {
        if (key.startsWith(codeFrom) || key.startsWith(codeUP)) {
            keysToDelete.push(key);
        }
    }
    keysToDelete.forEach(key => params.delete(key));
    const newUrl = window.location.pathname + '?' + params.toString();
    window.location.href = newUrl;
}

   const filterForm = document.getElementById('filterForm');
   if (filterForm) {
    filterForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const params = new URLSearchParams();

        const currentParams = new URLSearchParams(window.location.search);
        if (currentParams.has('months')) {
            params.append('months', currentParams.get('months'));
        }

        for (let [key, value] of formData.entries()) {
            if (key !== 'apply_filter' && value !== '') {
                params.append(key, value);
            }
        }

        const newUrl = window.location.pathname + '?' + params.toString();
        window.location.href = newUrl;
    });
}
*/
