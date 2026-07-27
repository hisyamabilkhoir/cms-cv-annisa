document.addEventListener('DOMContentLoaded', function() {
    const tables = document.querySelectorAll('.custom-datatable');
    
    tables.forEach(table => {
        const wrapper = document.createElement('div');
        wrapper.className = 'datatable-wrapper';
        table.parentNode.insertBefore(wrapper, table);
        wrapper.appendChild(table);

        // Add Search Input
        const controlsDiv = document.createElement('div');
        controlsDiv.className = 'd-flex justify-content-between mb-3';
        
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = 'Cari data...';
        searchInput.className = 'form-control w-25';
        
        const showEntries = document.createElement('select');
        showEntries.className = 'form-select w-auto';
        [5, 10, 25, 50].forEach(num => {
            const opt = document.createElement('option');
            opt.value = num;
            opt.textContent = 'Tampilkan ' + num;
            showEntries.appendChild(opt);
        });

        controlsDiv.appendChild(showEntries);
        controlsDiv.appendChild(searchInput);
        wrapper.insertBefore(controlsDiv, table);

        const tbody = table.querySelector('tbody');
        let rows = Array.from(tbody.querySelectorAll('tr'));
        
        let currentPage = 1;
        let rowsPerPage = parseInt(showEntries.value);
        let searchQuery = '';

        function renderTable() {
            // Filter
            const filteredRows = rows.filter(row => {
                return row.textContent.toLowerCase().includes(searchQuery.toLowerCase());
            });

            // Pagination
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedRows = filteredRows.slice(start, end);

            tbody.innerHTML = '';
            paginatedRows.forEach(row => tbody.appendChild(row));
            
            updatePagination(filteredRows.length);
        }

        // Search event
        searchInput.addEventListener('input', function(e) {
            searchQuery = e.target.value;
            currentPage = 1;
            renderTable();
        });

        // Show entries event
        showEntries.addEventListener('change', function(e) {
            rowsPerPage = parseInt(e.target.value);
            currentPage = 1;
            renderTable();
        });

        // Pagination UI
        const paginationDiv = document.createElement('div');
        paginationDiv.className = 'd-flex justify-content-between mt-3 align-items-center';
        wrapper.appendChild(paginationDiv);

        function updatePagination(totalRows) {
            paginationDiv.innerHTML = '';
            const totalPages = Math.ceil(totalRows / rowsPerPage);
            
            const info = document.createElement('div');
            info.className = 'text-muted';
            const startInfo = totalRows === 0 ? 0 : ((currentPage - 1) * rowsPerPage) + 1;
            const endInfo = Math.min(currentPage * rowsPerPage, totalRows);
            info.textContent = `Menampilkan ${startInfo} sampai ${endInfo} dari ${totalRows} data`;
            
            const ul = document.createElement('ul');
            ul.className = 'pagination mb-0';

            // Prev
            const prevLi = document.createElement('li');
            prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
            prevLi.innerHTML = `<button class="page-link">&laquo;</button>`;
            prevLi.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderTable();
                }
            });
            ul.appendChild(prevLi);

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                const li = document.createElement('li');
                li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                li.innerHTML = `<button class="page-link" style="${i === currentPage ? 'background-color: var(--primary-color); border-color: var(--primary-color); color: white;' : 'color: var(--primary-color);'}">${i}</button>`;
                li.addEventListener('click', () => {
                    currentPage = i;
                    renderTable();
                });
                ul.appendChild(li);
            }

            // Next
            const nextLi = document.createElement('li');
            nextLi.className = `page-item ${currentPage === totalPages || totalPages === 0 ? 'disabled' : ''}`;
            nextLi.innerHTML = `<button class="page-link">&raquo;</button>`;
            nextLi.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderTable();
                }
            });
            ul.appendChild(nextLi);

            paginationDiv.appendChild(info);
            paginationDiv.appendChild(ul);
        }

        // Sort Event
        const headers = table.querySelectorAll('th');
        headers.forEach((th, index) => {
            if (th.classList.contains('no-sort')) return;
            
            th.style.cursor = 'pointer';
            let sortAsc = true;
            
            th.addEventListener('click', () => {
                rows.sort((a, b) => {
                    let valA = a.children[index].textContent.trim();
                    let valB = b.children[index].textContent.trim();
                    
                    if (!isNaN(valA) && !isNaN(valB)) {
                        return sortAsc ? valA - valB : valB - valA;
                    }
                    return sortAsc ? valA.localeCompare(valB) : valB.localeCompare(valA);
                });
                sortAsc = !sortAsc;
                renderTable();
            });
        });

        renderTable();
    });
});
