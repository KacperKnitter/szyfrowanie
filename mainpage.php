
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
    require_once ('szyfrowania.php');
    ?>
    <form action="mainpage.php" method="post">
        Input <input id="Input" type="text" name="Text" value="<?php if(isset($_POST['Text'])) echo $_POST['Text'] ?>""><br>

        Output <input  id="Output" type="text" name="Przerobiony" value="<?php if(isset($_POST['Przerobiony'])) echo $_POST['Przerobiony'] ?>"><br>

        Wzór szyfru Afinicznego: ax+b=c<br>
        Afiniczny a <input type="text" name="cesar_a" value="<?php if(isset($_POST['cesar_a'])) echo $_POST['cesar_a'] ?>">
        Afiniczny b <input type="text" name="cesar_b" value="<?php if(isset($_POST['cesar_b'])) echo $_POST['cesar_b'] ?>"><br>
        Słowo klucz Vigenere <input type="text" name="slowoKlucz" value="<?php if(isset($_POST['slowoKlucz'])) echo $_POST['slowoKlucz'] ?>"><br>
        <select name="akcja" aria-label="Default select example">
            <option selected>Wybierz co chcesz zrobic </option>
            <option value="na Morsa">Przetłumacz na Morse'a</option>
            <option value="na Afini">Zaszyfruj za pomocą szyfru Afinicznego</option>
            <option value="na Vigenere">Zaszyfruj za pomocą szyfru Vigenère’a</option>
            <option value="z Morsa">Przetłumacz z Morse'a</option>
            <option value="z Afini">Odszyfruj za pomocą szyfru Afinicznego</option>
            <option value="z Vigenere">Odszyfruj za pomocą szyfru Vigenère’a</option>
        </select>
        <input type="submit" value="Wykonaj">
    </form>
    <button onclick="downloadOutput()">Pobierz output</button>
    <button onclick="downloadInput()">Pobierz Input</button>
    <pre>

        </pre>
</div>
</body>
</html>
