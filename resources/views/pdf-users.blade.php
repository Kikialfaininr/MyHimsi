<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px double black;
            padding: 10px;
        }

        .header img {
            height: 80px;
        }

        .header {
            text-align: center;
            flex: 1;
            margin: 0 20px;
        }

        .header .title {
            text-align: center;
            padding: 0 120px;
        }

        .header h1 {
            font-size: 20px;
        }

        .header p {
            margin: 2px 10px;
            font-size: 15px;
            font-style: italic;
        }

        .content {
            padding: 10px;
        }

        .content h1 {
            font-size: 18px;
            text-decoration: underline;
            text-align: center;
        }

        .content table,
        .content th,
        .content td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }
        .sign {
            margin-left: 730px;
        }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td><img src="{{ $himsiSrc }}" alt="Logo HIMSI"></td>
                <td class="title">
                    <h1>HIMPUNAN MAHASISWA SISTEM INFORMASI</h1>
                    <h1>UNIVERSITAS HARAPAN BANGSA</h1>
                    <p>Sekretariat : Jl. Wahid Hasyim No.274 A, Karangklesem, Purwokerto Selatan</p>
                    <p>Telp.087773705521</p>
                </td>
                <td><img src="{{ $uhbSrc }}" alt="Logo UHB"></td>
            </tr>
        </table>
    </div>

    <div class="content">
        <h1>DATA LOGIN ANGGOTA</h1>
        <table id="example" class="table table-responsive table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $no => $value)
                <tr>
                    <td align="center">{{$no+1}}</td>
                    <td>{{$value->anggota->full_name}}</td>
                    <td>{{$value->name}}</td> 
                    <td>{{$value->email}}</td> 
                    <td>{{$value->password}}</td>  
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="sign">
        <p>Purwokerto, {{ $currentDate }}</p>
        <p>Ketua Umum</p>
        <br><br><br>
        <p>Ulan Juniarti</p>
    </div>
</body>
</html>