<?php
	class DB{

		protected $koneksi;

		function bukaKoneksi(){
			try{
				$this->koneksi = new PDO("mysql:host=localhost;dbname=0skr_pegawai","root","", array(PDO::ATTR_PERSISTENT=>TRUE));
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			return $this->koneksi;
		}

		function LoginAdmin($username, $password){
			try{
				$sql = $this->bukaKoneksi()->prepare("select * from admin where username = :username and password = :password");
				$sql->bindParam(':username', $username);
				$sql->bindParam(':password', $password);
				$sql->execute();
				return $sql;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}
	}

	class Lowongan extends DB{
		private $sqlInsert;
		private $sqlEdit;
		private $sqlHapus;
		private $sqlUmumkan;

		function __construct(){
			try{
				$this->sqlInsert = $this->bukaKoneksi()->prepare("insert into lowongan values ('', :lowongan, :kuota, :status, '0')");
				$this->sqlHapus = $this->bukaKoneksi()->prepare("delete from lowongan where id_lowongan = :id_lowongan");
				$this->sqlEdit = $this->bukaKoneksi()->prepare("update lowongan set lowongan=:lowongan, kuota=:kuota, status=:status where id_lowongan=:id_lowongan");
				$this->sqlUmumkan = $this->bukaKoneksi()->prepare("update lowongan set pengumuman=:pengumuman where id_lowongan=:id_lowongan");
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function GetData($qry_custom){
			try{
				$sql = $this->bukaKoneksi()->prepare("select * from lowongan " . $qry_custom);
				$sql->execute();
				return $sql;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function InsertData($lowongan, $kuota, $status){
			try{
				$this->sqlInsert->bindParam(':lowongan', $lowongan);
				$this->sqlInsert->bindParam(':kuota', $kuota);
				$this->sqlInsert->bindParam(':status', $status);
				$this->sqlInsert->execute();
				return $this->sqlInsert;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function HapusData($id_lowongan){
			try{
				$this->sqlHapus->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlHapus->execute();
				return $this->sqlHapus;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function EditData($lowongan, $kuota, $status, $id_lowongan){
			try{
				$this->sqlEdit->bindParam(':lowongan', $lowongan);
				$this->sqlEdit->bindParam(':kuota', $kuota);
				$this->sqlEdit->bindParam(':status', $status);
				$this->sqlEdit->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlEdit->execute();
				return $this->sqlEdit;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function SetPengumuman($pengumuman, $id_lowongan){
			try{
				$this->sqlUmumkan->bindParam(':pengumuman', $pengumuman);
				$this->sqlUmumkan->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlUmumkan->execute();
				return $this->sqlUmumkan;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}
	}

	class LowonganRinci extends DB{
		private $sqlDataLowongan;
		private $sqlInsert;
		private $sqlEdit;
		private $sqlHapus;
		private $sqlHapusLamaran;

		function __construct(){
			$this->sqlDataLowongan = $this->bukaKoneksi()->prepare("select * from lowongan_rinci where id_lowongan=:id_lowongan");
			$this->sqlInsert = $this->bukaKoneksi()->prepare("insert into lowongan_rinci values ('', :id_lowongan, :kriteria, :bobot, :nilai, :upload)");
			$this->sqlEdit = $this->bukaKoneksi()->prepare("update lowongan_rinci set kriteria=:kriteria, bobot=:bobot, status_nilai=:nilai, status_upload=:upload where id_lowongan_rinci=:id_lowongan_rinci");
			$this->sqlHapus = $this->bukaKoneksi()->prepare("delete from lowongan_rinci where id_lowongan_rinci=:id_lowongan_rinci");
			$this->sqlHapusLamaran = $this->bukaKoneksi()->prepare("delete from pelamar where id_lowongan=:id_lowongan and kriteria=:kriteria");
		}

		function GetData($qry_custom){
			try{
				$sql = $this->bukaKoneksi()->prepare("select * from lowongan_rinci " . $qry_custom);
				$sql->execute();
				return $sql;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function InsertData($id_lowongan, $kriteria, $bobot, $nilai, $upload){
			try{
				$this->sqlInsert->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlInsert->bindParam(':kriteria', $kriteria);
				$this->sqlInsert->bindParam(':bobot', $bobot);
				$this->sqlInsert->bindParam(':nilai', $nilai);
				$this->sqlInsert->bindParam(':upload', $upload);
				$this->sqlInsert->execute();
				return $this->sqlInsert;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function GetDataLowongan($id_lowongan){
			try{
				$this->sqlDataLowongan->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlDataLowongan->execute();
				return $this->sqlDataLowongan;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function EditData($kriteria, $bobot, $nilai, $upload, $id_lowongan_rinci){
			try{
				$this->sqlEdit->bindParam(':kriteria', $kriteria);
				$this->sqlEdit->bindParam(':bobot', $bobot);
				$this->sqlEdit->bindParam(':nilai', $nilai);
				$this->sqlEdit->bindParam(':upload', $upload);
				$this->sqlEdit->bindParam(':id_lowongan_rinci', $id_lowongan_rinci);
				$this->sqlEdit->execute();
				return $this->sqlEdit;
			}catch (PDOException $e){
				$e->getMessage();
			}
		}

		function HapusData($id_lowongan_rinci){
			try{
				$this->sqlHapus->bindParam(':id_lowongan_rinci', $id_lowongan_rinci);
				$this->sqlHapus->execute();
				return $this->sqlHapus;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function HapusKriteriaLamaran($id_lowongan, $kriteria){
			try{
				$this->sqlHapusLamaran->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlHapusLamaran->bindParam(':kriteria', $kriteria);
				$this->sqlHapusLamaran->execute();
				return $this->sqlHapusLamaran;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

	}

	class User extends DB{
		private $sqlRegister;
		private $sqlUpdate;

		function __construct(){
			$this->sqlRegister = $this->bukaKoneksi()->prepare("insert into users (nama_lengkap, username, password, email) values (:nama_lengkap, :username, :password, :email)");
			$this->sqlUpdate = $this->bukaKoneksi()->prepare("update users set nama_lengkap=:nama_lengkap, alamat=:alamat, tempat_lahir=:tempat_lahir, tanggal_lahir=:tanggal_lahir, no_hp=:no_hp, email=:email, pendidikan=:pendidikan, file_cv=:file_cv, foto=:foto where id_user=:id_user");
		}

		function GetData($qry_custom){
			try{
				$sql = $this->bukaKoneksi()->prepare("select * from users " . $qry_custom);
				$sql->execute();
				return $sql;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function Register($nama_lengkap, $username, $password, $email){
			try{
				$this->sqlRegister->bindParam(':nama_lengkap', $nama_lengkap);
				$this->sqlRegister->bindParam(':username', $username);
				$this->sqlRegister->bindParam(':password', $password);
				$this->sqlRegister->bindParam(':email', $email);
				$this->sqlRegister->execute();
				return $this->sqlRegister;
			}catch (PDOException $e){
				$e->getMessage();
			}
		}

		function LoginUser($username, $password){
			try{
				$sql = $this->bukaKoneksi()->prepare("select * from users where username=:username and password=:password");
				$sql->bindParam(':username', $username);
				$sql->bindParam(':password', $password);
				$sql->execute();
				return $sql;
			}catch (PDOException $e){
				$e->getMessage();
			}
		}

		function UpdateData($nama_lengkap, $alamat, $tempat_lahir, $tanggal_lahir, $no_hp, $email, $pendidikan, $file_cv, $foto,  $id_user){
			try{
				$this->sqlUpdate->bindParam(':nama_lengkap', $nama_lengkap);
				$this->sqlUpdate->bindParam(':alamat', $alamat);
				$this->sqlUpdate->bindParam(':tempat_lahir', $tempat_lahir);
				$this->sqlUpdate->bindParam(':tanggal_lahir', $tanggal_lahir);
				$this->sqlUpdate->bindParam(':no_hp', $no_hp);
				$this->sqlUpdate->bindParam(':email', $email);
				$this->sqlUpdate->bindParam('pendidikan', $pendidikan);
				$this->sqlUpdate->bindParam(':file_cv', $file_cv);
				$this->sqlUpdate->bindParam(':foto', $foto);
				$this->sqlUpdate->bindParam(':id_user', $id_user);
				$this->sqlUpdate->execute();
				return $this->sqlUpdate;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}
	}

	class Pelamar extends DB{
		private $sqlCekLamaran;
		private $sqlInsertAwal;
		private $sqlUploadBerkas;
		private $sqlSetNilai;
		private $sqlInsertAwalHitung;

		function __construct(){
			$this->sqlCekLamaran = $this->bukaKoneksi()->prepare("select * from pelamar where id_user=:id_user and id_lowongan=:id_lowongan");
			$this->sqlInsertAwal = $this->bukaKoneksi()->prepare("insert into pelamar (id_user, id_lowongan, kriteria) values (:id_user, :id_lowongan, :kriteria)");
			$this->sqlUploadBerkas = $this->bukaKoneksi()->prepare("update pelamar set file=:file where id_user=:id_user and id_lowongan=:id_lowongan and kriteria=:kriteria");
			$this->sqlSetNilai = $this->bukaKoneksi()->prepare("update pelamar set nilai=:nilai where id_user=:id_user and id_lowongan=:id_lowongan and kriteria=:kriteria");
			$this->sqlInsertAwalHitung = $this->bukaKoneksi()->prepare("insert into hitung (id_user, id_lowongan) values (:id_user, :id_lowongan)");
		}

		function GetData($qry_custom){
			try{
				$sql = $this->bukaKoneksi()->prepare("select * from pelamar " . $qry_custom);
				$sql->execute();
				return $sql;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function CekLamaran($id_user, $id_lowongan){
			try{
				$this->sqlCekLamaran->bindParam(':id_user', $id_user);
				$this->sqlCekLamaran->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlCekLamaran->execute();
				return $this->sqlCekLamaran;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function InsertAwal($id_user, $id_lowongan, $kriteria){
			try{
				$this->sqlInsertAwal->bindParam(':id_user', $id_user);
				$this->sqlInsertAwal->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlInsertAwal->bindParam(':kriteria', $kriteria);
				$this->sqlInsertAwal->execute();
				return $this->sqlInsertAwal;
			}catch (PDOException $e){
				print $e->getMessage();
			}	
		}

		function InsertAwalHitung($id_user, $id_lowongan){
			try{
				$this->sqlInsertAwalHitung->bindParam(':id_user', $id_user);
				$this->sqlInsertAwalHitung->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlInsertAwalHitung->execute();
				return $this->sqlInsertAwalHitung;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function UploadBerkas($file, $id_user, $id_lowongan, $kriteria){
			try{
				$this->sqlUploadBerkas->bindParam(':file', $file);
				$this->sqlUploadBerkas->bindParam(':id_user', $id_user);
				$this->sqlUploadBerkas->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlUploadBerkas->bindParam(':kriteria', $kriteria);
				$this->sqlUploadBerkas->execute();
				return $this->sqlUploadBerkas;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function SetNilai($nilai, $id_user, $id_lowongan, $kriteria){
			try{
				$this->sqlSetNilai->bindParam(':nilai', $nilai);
				$this->sqlSetNilai->bindParam(':id_user', $id_user);
				$this->sqlSetNilai->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlSetNilai->bindParam(':kriteria', $kriteria);
				$this->sqlSetNilai->execute();
				return $this->sqlSetNilai;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}
	}

	class File extends DB{
		private $sqlInsert;
		private $sqlEdit;
		private $sqlHapus;

		function __construct(){
			$this->sqlInsert = $this->bukaKoneksi()->prepare("insert into file values ('', :nama_file, :file)");
			$this->sqlEdit = $this->bukaKoneksi()->prepare("update file set nama_file=:nama_file, file=:file where id_file=:id_file");
			$this->sqlHapus = $this->bukaKoneksi()->prepare("delete from file where id_file=:id_file");
		}

		function GetData($qry_custom){
			try{
				$sql = $this->bukaKoneksi()->prepare("select * from file " . $qry_custom);
				$sql->execute();
				return $sql;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function InsertData($nama_file, $file){
			try{
				$this->sqlInsert->bindParam(':nama_file', $nama_file);
				$this->sqlInsert->bindParam(':file', $file);
				$this->sqlInsert->execute();
				return $this->sqlInsert;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function EditData($nama_file, $file, $id_file){
			try{
				$this->sqlEdit->bindParam(':nama_file', $nama_file);
				$this->sqlEdit->bindParam(':file', $file);
				$this->sqlEdit->bindParam(':id_file', $id_file);
				$this->sqlEdit->execute();
				return $this->sqlEdit;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function HapusData($id_file){
			try{
				$this->sqlHapus->bindParam(':id_file', $id_file);
				$this->sqlHapus->execute();
				return $this->sqlHapus;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}
	}

	class HitungSPK extends DB{
		private $sqlBobot;
		private $sqlVektorS;
		private $sqlSumVS;
		private $sqlUpV;
		private $sqlRanking;

		function __construct(){
			$this->sqlBobot = $this->bukaKoneksi()->prepare("select sum(bobot) as sum from lowongan_rinci where id_lowongan=:id_lowongan and bobot > 0");
			$this->sqlVektorS = $this->bukaKoneksi()->prepare("update hitung set vektor_s=:vektor_s where id_user=:id_user and id_lowongan=:id_lowongan");
			$this->sqlSumVS = $this->bukaKoneksi()->prepare("select sum(vektor_s) as sum from hitung where id_lowongan=:id_lowongan");
			$this->sqlUpV = $this->bukaKoneksi()->prepare("update hitung set vektor_v=:vektor_v where id_user=:id_user and id_lowongan=:id_lowongan");
		}

		function GetData($qry_custom){
			try{
				$sql = $this->bukaKoneksi()->prepare("select * from hitung " . $qry_custom);
				$sql->execute();
				return $sql;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function NormalisasiBobot($id_lowongan){
			try{
				$this->sqlBobot->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlBobot->execute();
				$ft = $this->sqlBobot->fetch();;
				$sum = $ft['sum'];
				return $sum;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function SetVektor_S($vektor_s, $id_user, $id_lowongan){
			try{
				$this->sqlVektorS->bindParam(':vektor_s', $vektor_s);
				$this->sqlVektorS->bindParam(':id_user', $id_user);
				$this->sqlVektorS->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlVektorS->execute();
				return $this->sqlVektorS;
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

		function SetVektor_V($id_user, $id_lowongan){
			try{
				$this->sqlSumVS->bindParam(':id_lowongan', $id_lowongan);
				$this->sqlSumVS->execute();
				$ft = $this->sqlSumVS->fetch();
				$sumVS = $ft['sum'];

				$ch = $this->GetData("where id_lowongan='$id_lowongan' and id_user = '$id_user'");
				while($data = $ch->fetch()){
					$vkt_v = $data['vektor_s'] / $sumVS;
					$this->sqlUpV->bindParam(':vektor_v', $vkt_v);
					$this->sqlUpV->bindParam(':id_lowongan', $id_lowongan);
					$this->sqlUpV->bindParam(':id_user', $id_user);
					$this->sqlUpV->execute();
				}
			}catch (PDOException $e){
				print $e->getMessage();
			}
		}

	}
?>