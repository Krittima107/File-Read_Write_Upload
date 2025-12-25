<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ฟอร์มลงทะเบียนอบรม</title>
</head>

<body>

    <h2>ฟอร์มลงทะเบียนอบรม</h2>

    <form method="post">
        ชื่อ-นามสกุล: <br>
        <input type="text" name="fullname" required><br><br>

        Email: <br>
        <input type="email" name="email" required><br><br>

        หัวข้ออบรม: <br>
        <select name="course">
            <option value="AI สำหรับงานสำนักงาน">AI สำหรับงานสำนักงาน</option>
            <option value="Excel สำหรับการทำงาน">Excel สำหรับการทำงาน</option>
            <option value="การเขียนเว็บไซต์ PHP">การเขียนเว็บไซต์ PHP</option>
        </select><br><br>

        อาหารที่ต้องการ: <br>
        <input type="checkbox" name="food[]" value="ปกติ"> ปกติ
        <input type="checkbox" name="food[]" value="มังสวิรัติ"> มังสวิรัติ
        <input type="checkbox" name="food[]" value="ฮาลาล"> ฮาลาล
        <br><br>

        รูปแบบการเข้าร่วม: <br>
        <input type="radio" name="type" value="Onsite" required> Onsite
        <input type="radio" name="type" value="Online"> Online
        <br><br>

        <button type="submit" name="submit">ลงทะเบียน</button>

        <?php
        if (isset($_POST['submit'])) {

            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $course = $_POST['course'];
            $type = $_POST['type'];

            // อาหาร (Checkbox)
            if (isset($_POST['food'])) {
                $food = implode(",", $_POST['food']);
            } else {
                $food = "ไม่ระบุ";
            }

            // ค่าลงทะเบียน
            if ($type == "Onsite") {
                $price = 1500;
            } else {
                $price = 800;
            }

            // บันทึกลงไฟล์
            $data = $fullname . "|" . $email . "|" . $course . "|" . $food . "|" . $type . "|" . $price . "\n";
            file_put_contents("register.txt", $data, FILE_APPEND);

            // แสดงผล
            echo "<h3>ลงทะเบียนสำเร็จ</h3>";
            echo "ชื่อ: $fullname <br>";
            echo "อีเมล: $email <br>";
            echo "หัวข้ออบรม: $course <br>";
            echo "อาหาร: $food <br>";
            echo "รูปแบบ: $type <br>";
            echo "ค่าลงทะเบียน: " . number_format($price, 2) . " บาท<br>";
        }
        ?>

        <h3>รายชื่อผู้ลงทะเบียนทั้งหมด</h3>

        <?php
        if (file_exists("register.txt")) {

            $lines = file("register.txt");

            echo "<table border='1' cellpadding='5'>";
            echo "<tr>
            <th>ชื่อ</th>
            <th>Email</th>
            <th>หัวข้อ</th>
            <th>อาหาร</th>
            <th>รูปแบบ</th>
            <th>ค่าลงทะเบียน</th>
          </tr>";

            foreach ($lines as $line) {
                list($name, $email, $course, $food, $type, $price) = explode("|", trim($line));

                echo "<tr>
                <td>$name</td>
                <td>$email</td>
                <td>$course</td>
                <td>$food</td>
                <td>$type</td>
                <td>" . number_format($price, 2) . "</td>
              </tr>";
            }

            echo "</table>";
        }
        ?>

    </form>

</body>

</html>