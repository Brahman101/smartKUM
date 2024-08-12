document.addEventListener("DOMContentLoaded", function () {
    const dropdowns = [
        {
            id: "dropdownTipe",
            itemClass: "item-tipe-dokumen",
            inputId: "tipeDokumen",
        },
        {
            id: "dropdownJenis",
            itemClass: "item-jenis-dokumen",
            inputId: "jenisDokumen",
        },
        { id: "dropdownStatus", itemClass: "item-status", inputId: "status" },
    ];

    dropdowns.forEach(function (dropdown) {
        const dropdownElement = document.getElementById(dropdown.id);
        const dropdownItems = document.querySelectorAll(
            `.dropdown-item.${dropdown.itemClass}`
        );
        const inputElement = document.getElementById(dropdown.inputId);

        dropdownItems.forEach(function (item) {
            item.addEventListener("click", function (e) {
                e.preventDefault();
                const selectedValue = item.getAttribute("data-value");
                dropdownElement.textContent = selectedValue || "- Status -";
                inputElement.value = selectedValue;
            });
        });
    });
});
