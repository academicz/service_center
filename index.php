<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="registration.php" method="post">
      <label for="name">Name</label>
      <input type="text" name="name" id="name">
<label for="age">Age</label>
      <input type="number" name="age" id="age">
      Male<input type="radio" name="gender" value="male">
      Female <input type="radio" name="gender" value="Female">
<label for="address">Address</label>
<textarea name="address" rows="4" cols="10"></textarea>
<label for="state">State</label>
<select name="state" id="state">
  <option value="1">Kerala</option>
  <option value="2">Tamilnadu</option>
</select>
Reading<input type="checkbox" name="hobby[]" value="Reading">
Writing<input type="checkbox" name="hobby[]" value="Writing">
<button type="submit">Add</button>
    </form>
  </body>
</html>
