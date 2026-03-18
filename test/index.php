<!DOCTYPE html>
<head>
<title>Contact us</title>
</head>
<link href="style.css" rel="stylesheet"></link>
<body>

<div id="form-container">
  <div id="inner-form-container">
    <form action="code.php" method="POST">
        <h4 id="header">Contact Us:</h4>
        <label for="name">Name: </label>
        <input id="name" name="name" type="text" placeholder="Name" size="30" required>
        <br>
        <br>

        <label for="email">Your Email: </label>
        <input id="email" name="email" type="email" placeholder="example@example.com" size="23" required>
        <br>
        <br>

        <label for="whom">To Whom: </label>
        <select name="whom" id="whom">
            <option value="fred@gmail.com">Fred Flintstone</option>
            <option value="voltron@gmail.com">Voltron</option>
            <option value="barney@gmail.com">Barney The Dinosaur</option>
        </select>
        <br>
        <br>

        <label for="subject">Subject: </label>
        <input id="subject" name="subject" type="text" placeholder="Subject" size="28">
        <br>
        <br>

        <label for="comment">Message: </label><br/>
        <textarea id="comment" name="comment" placeholder="Message here..." rows="15" cols="40"></textarea>
        <br>
        <br>

        <input id="submit" type="submit" value="Submit">
    </form>
  </div>
</div>

</body>
</html>