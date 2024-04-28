<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A500%2C700" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A500%2C700" />
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/general/contact_us.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
</head>

<body>
    <div class="blueArea">
        <div class="welcomePage" id="welcomePage">
            <div class="logoDiv">
                <div>P</div>
                <h5>PrescripSmart</h5>
            </div>
        </div>
    </div>

    <div class="container">
        <header>
            <h1>Contact Us</h1>
        </header>
        <div class="content">
            <div id="map"></div>
            <div class = "details">
            <br><h3>Address: </h3>
            <p>Reid Avenue, Colombo 07, Sri Lanka</p><br>
            <h3>Contact Number:</h3>
            <p>+94 774936420</p><br>
            <h3>Email Address:</h3>
            <p><a href="mailto:prescripsmart@gmail.com">prescripsmart@gmail.com</a></p>
            </div>
        </div>

        <script>

            (g => { var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__", m = document, b = window;
            b = b[c] || (b[c] = {});
            var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams, u = () => h || (h = new Promise(async (f, n) => { await (a = m.createElement("script"));
            e.set("libraries", [...r] + "");
            for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
            e.set("callback", c + ".maps." + q);
            a.src = `https://maps.${c}apis.com/maps/api/js?` + e; d[q] = f;
            a.onerror = () => h = n(Error(p + " could not load."));
            a.nonce = m.querySelector("script[nonce]")?.nonce || "";
            m.head.append(a) }));
            d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n)) 
            })

            ({
                key: "",
                v: "weekly",
            });

        </script>
        <script>
            let map;

            async function initMap() {
                const position = { lat: 6.90248241466162, lng: 79.86117435910631 };
                const { Map } = await google.maps.importLibrary("maps");
                const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

                map = new Map(document.getElementById("map"), {
                    zoom: 15,
                    center: position,
                    mapId: "DEMO_MAP_ID",
                });

                const marker = new AdvancedMarkerElement({
                    map: map,
                    position: position,
                    title: "PrescripSmart",
                });
            }

            initMap();
        </script>
</body>

</html>