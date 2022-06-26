<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.css">
<script>
    function downloadFile ( data, name ) {
        const blob = new Blob([data], {type: "octet-stream"});
        const href = URL.createObjectURL(blob);
        const a = Object.assign(document.createElement("a"), {
            href,
            style: " display : none ",
            download: name,
        });
        document.body.appendChild(a)
        a.click();
        URL.revokeObjectURL(href);
        a.remove();
    }
    function downloadInput() {
         a=(document.getElementById("Input").value)
        name="Input.txt";
        downloadFile(a,name);
    }
    function downloadOutput() {
        name="Output.txt";
         a=document.getElementById("Output").value
        downloadFile(a, name);
    }
    </script>
    <title>Agents Device</title>
</head>
<body>

<div>
    <?php
    require_once ('Szyfrowania.php');
    ?>
</div>

<div style="margin-top: 12rem" class="container">
    <div class="row justify-content-center">

            <div  style="margin-top: 2rem" class="col-lg-4 col-md-12">
                <div style="text-align: center;"/>
                    <form action="mainpage.php" method="post">
                        Input<br>  <textarea style="height: 10rem;width:18rem " id="Input"  name="Text"><?php if(isset($_POST['Text'])) echo $_POST['Text'] ?></textarea> <br>
                    <button class="btn btn-secondary" onclick="downloadInput()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                            <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                        </svg>
                    </button><br>
                        <input id="import" type="file" >
                </div>
            </div>

        <div style="margin-top: 2rem" class="col-lg-4 col-md-12">
                <div style="text-align: center;"/>
                    Wzór szyfru Afinicznego: ax+b=c<br>
                    Afiniczny a <br><input type="number" name="cesar_a" min="-9" max="9" value="<?php if(isset($_POST['cesar_a'])) echo $_POST['cesar_a'] ?>"><br>
                    Afiniczny b <br><input type="number" name="cesar_b" min="-25" max="25"  value="<?php if(isset($_POST['cesar_b'])) echo $_POST['cesar_b'] ?>"><br>
                    Słowo klucz Vigenere <br> <input type="text" name="slowoKlucz" value="<?php if(isset($_POST['slowoKlucz'])) echo $_POST['slowoKlucz'] ?>"><br>
                    <select style="margin-top: 0.5rem;margin-bottom: 0.5rem" name="akcja" aria-label="Default select example">
                        <option selected>Wybierz co chcesz zrobic </option>
                        <option value="na Morsa">Przetłumacz na Morse'a</option>
                        <option value="na Afini">Zaszyfruj za pomocą szyfru Afinicznego</option>
                        <option value="na Vigenere">Zaszyfruj za pomocą szyfru Vigenère’a</option>
                        <option value="z Morsa">Przetłumacz z Morse'a</option>
                        <option value="z Afini">Odszyfruj za pomocą szyfru Afinicznego</option>
                        <option value="z Vigenere">Odszyfruj za pomocą szyfru Vigenère’a</option>
                    </select><br>
                    <input type="submit" value="Wykonaj">
                </div>
        </div>

        <div style="margin-top: 2rem" class="col-lg-4 col-md-12">
            <div style="text-align: center;"/>
                Output<br> <textarea  style="height: 10rem;width:18rem " id="Output"  name="Output" ><?php if(isset($_POST['Przerobiony'])) echo $_POST['Przerobiony']?></textarea><br>
                <button class="btn btn-secondary" onclick="downloadOutput()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1h-2z"/>
                        <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                    </svg>
                </button>
            </from>
            </div>
        </div>

    </div>
</div>
<script src ="script.js">
</script>
</body>
</html>
