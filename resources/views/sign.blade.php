<!DOCTYPE html>
<html>
<head>
	<title>Tutorial Membuat Pencarian Pada Laravel - www.malasngoding.com</title>
</head>
<body>

	<style type="text/css">
		.pagination li{
			float: left;
			list-style-type: none;
			margin:5px;
		}
	</style>

	<h2><a href="https://www.malasngoding.com">www.malasngoding.com</a></h2>
	<h3>Data Pegawai</h3>


	<p>Cari QR Codes :</p>
	<form action="{{ route('search') }}" method="GET">
		<input type="text" name="search" placeholder="Cari Pegawai .." value="{{ old('search') }}">
		<input type="submit" value="CARI">
	</form>
		
	<br/>

	<table border="1">
		<tr>
			{{-- <th>Dokumen</th> --}}
			<th>Hash</th>
			<th>Image</th>
		</tr>
		@foreach($qrcodes as $q)
		<tr>
			{{-- <td>{{ $q->dokumen->judul }}</td> --}}
			<td>{{ $q->hash }}</td>
			<td>{{ $q->image }}</td>
		</tr>
		@endforeach
	</table>

	<br/>
	Halaman : {{ $qrcodes->currentPage() }} <br/>
	Jumlah Data : {{ $qrcodes->total() }} <br/>
	Data Per Halaman : {{ $qrcodes->perPage() }} <br/>


	{{ $qrcodes->links() }}


</body>
</html>