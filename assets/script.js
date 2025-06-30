const keyword = document.getElementById("keyword");

keyword.addEventListener("keyup", function() {
    const filter = keyword.value.toLowerCase();
    const rows = document.querySelectorAll("tr.tableItem");
    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        if (text.includes(filter)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});