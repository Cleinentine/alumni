let citySelect = document.getElementById('city');

document.getElementById('country').addEventListener('change', function() {
    let countryId = this.value;
    let stateSelect = document.getElementById('state');
        stateSelect.innerHTML = '<option>Loading...</option>';
        citySelect.innerHTML = '<option value="">-- Select --</option>';

    if (!countryId) {
        stateSelect.innerHTML = '<option>-- Select --</option>';
        return;
    }

    let formData = new FormData();
        formData.append('country_id', countryId);
    
    let xhr = new XMLHttpRequest();
        xhr.open("POST", "/tracer/countries", true);
        xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let states = JSON.parse(xhr.responseText);
                stateSelect.innerHTML = '<option value="">-- Select --</option>';

            if (Array.isArray(states)) {
                states.forEach(function(state) {
                    let opt = document.createElement('option');
                        opt.value = state.id;
                        opt.textContent = state.name;
                        stateSelect.appendChild(opt);
                });
            }
        }
    };

    xhr.send(formData);
});

document.getElementById('state').addEventListener('change', function() {
    let stateId = this.value;
        citySelect.innerHTML = '<option>Loading...</option>';

    if (!stateId) {
        citySelect.innerHTML = '<option>-- Select --</option>';
        return;
    }

    let formData = new FormData();
        formData.append('state_id', stateId);
    
    let xhr = new XMLHttpRequest();
        xhr.open("POST", "/tracer/states", true);
        xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            let cities = JSON.parse(xhr.responseText);
                citySelect.innerHTML = '<option value="">-- Select --</option>';

            if (Array.isArray(cities)) {
                cities.forEach(function(state) {
                    let opt = document.createElement('option');
                        opt.value = state.id;
                        opt.textContent = state.name;
                        citySelect.appendChild(opt);
                });
            }
        }
    };

    xhr.send(formData);
});