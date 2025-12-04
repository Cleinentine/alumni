document.getElementById("tracer-employment").classList.toggle("bg-yellow-400");
document.getElementById("tracer-employment").style.color = "#000";

const unemployed = document.getElementById("unemployed"),
    status = document.getElementById("status"),
    unemployment = document.getElementById("unemployment"),

    employment_form_01 = document.getElementById("employment-form-01"),
    industries = document.getElementById("industries-id"),
    search_methods = document.getElementById("search-methods-id"),
    address_form = document.getElementById("address-form");

if (status.value !== "Unemployed") {
    unemployed.style.display = "none";
} else {
    unemployed.style.display = "block";
    
    employment_form_01.style.display = "none";
    industries.style.display = "none";
    search_methods.style.display = "none";
    address_form.style.display = "none";
}

status.addEventListener("change", function() {
    if (status.value == "Unemployed") {
        unemployed.style.display = "block";

        employment_form_01.style.display = "none";
        industries.style.display = "none";
        search_methods.style.display = "none";
        address_form.style.display = "none";
    } else {
        unemployed.style.display = "none";
        unemployment.value = "";

        employment_form_01.style.display = "block";
        industries.style.display = "block";
        search_methods.style.display = "block";
        address_form.style.display = "block";
    }
});