<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>ฟอร์มลงทะเบียนอบรม</title>
    <style>
        body {
            font-family: "Segoe UI", Arial;
            margin: 0;
            padding: 40px;
            background: #f3f6f4;
            /* เทาเขียวอ่อน */
            color: #2f3e36;
            /* ตัวอักษรเข้มแต่ไม่ดำ */
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 800px;
            background: #ffffff;
            padding: 32px;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        h2,
        h3 {
            text-align: center;
            color: #355f4b;
            /* เขียวหม่น */
        }

        label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: #355f4b;
        }

        .group {
            margin-bottom: 18px;
        }

        /* input + select */
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #cdd7d2;
            background: #f9fbfa;
            font-size: 15px;
            color: #2f3e36;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #7bb59b;
            box-shadow: 0 0 0 3px rgba(123, 181, 155, 0.25);
        }

        /* checkbox / radio */
        input[type="checkbox"],
        input[type="radio"] {
            accent-color: #7bb59b;
            margin-right: 6px;
        }

        /* button */
        button {
            width: 100%;
            padding: 14px;
            background: #7bb59b;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: #6aa78c;
        }

        /* table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #e1e6e3;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #eef3f1;
            color: #355f4b;
        }
    </style>

</head>

<body>

    <div class="container">

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

                $food = isset($_POST['food']) ? implode(",", $_POST['food']) : "ไม่ระบุ";
                $price = ($type == "Onsite") ? 1500 : 800;

                $data = "$fullname|$email|$course|$food|$type|$price\n";
                file_put_contents("register.txt", $data, FILE_APPEND);

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

                echo "<table>";
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

    </div>

</body>


</html>