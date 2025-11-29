document.getElementById("lookup").addEventListener("click", () => {
    const country = document.getElementById("country").value;
    fetch(`world.php?country=${encodeURIComponent(country)}`)
    .then(res => res.text())
    .then(data =>
        {
            document.getElementById("result").innerHTML = data;
        })
        .catch(err => 
            {
                document.getElementById("result").innerHTML = "Error fetching data";
                console.error(err);
            });
        });
