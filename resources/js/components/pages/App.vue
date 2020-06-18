<template>
	<div :class="!dashboard?'container-fluid':''">
		<template v-if="dashboard">
			
			<router-view v-if="permisos==null"/>
			<!-- Page Wrapper -->
			<div id="wrapper" v-if="permisos!=null">
				<!-- Sidebar -->
				<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
					<!-- Sidebar - Brand -->
					<a href="#" class="sidebar-brand d-flex align-items-center justify-content-center">
						<div class="sidebar-brand-icon rotate-n-15">
						</div>
						<div class="sidebar-brand-text mx-3">Sistema de encuesta para COVID 19.</div>
					</a>
					<hr class="sidebar-divider my-0" >
						<template v-if="permisos.rol=='admin'">
						<div class="sidebar-heading">
							Usuarios
						</div>
						<li class="nav-item">
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<i class="fas fa-users-cog"></i>
							<span>Varios</span>
							</a>
							<div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
								<div class="bg-white py-2 collapse-inner rounded">
									<router-link class="collapse-item" :to="{ name: 'users'}">
										<i class="fas fa-list-ol"></i>
										Usuarios
									</router-link>								
								</div>
							</div>
						</li>
						<hr class="sidebar-divider my-0">
						</template>
						<div class="sidebar-heading">
							Encuesta
						</div>
						<li class="nav-item">
							<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
							<i class="fas fa-users-cog"></i>
							<span>Encuestas</span>
							</a>
							<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
								<div class="bg-white py-2 collapse-inner rounded">
									<router-link class="collapse-item" :to="{ name: 'encuestaNew'}">
										<i class="fas fa-list-ol"></i>
										Nueva
									</router-link>
									<router-link class="collapse-item" :to="{ name: 'encuestaIndex'}">
										<i class="fas fa-list-ol"></i>
										listado
									</router-link>
									
								</div>
							</div>
						</li>
						
				</ul>
				<!-- End of Sidebar -->
				<!-- Content Wrapper -->
				<div id="content-wrapper" class="d-flex flex-column">
					<!-- Main Content -->
					<div id="content">
						<!-- Topbar -->
						<nav v-if="menu.superior" class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
							<!-- Sidebar Toggle (Topbar) -->
							<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
							<i class="fa fa-bars"></i>
							</button>
							<!-- Topbar Navbar -->
							<ul class="navbar-nav ml-auto" >
								<!-- Nav Item - Messages -->
								<div class="topbar-divider d-none d-sm-block"></div>
								<li class="nav-item dropdown no-arrow">
									<b-dropdown variant="link" size="lg" toggle-class="text-decoration-none" no-caret right>
										<template slot="button-content">
											<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{name}}</span>
											<img style="width: 26px;" class="img-profile rounded-circle" :src="base+'/images/logo-ese.png'">
										</template>
										<b-dropdown-item :to="{name:'cambiarpass'}">
											<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
											cambiar<br>contraseña
										</b-dropdown-item>
										<b-dropdown-item @click="salir()">
											<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
											Salir
										</b-dropdown-item>
									</b-dropdown>
								</li>
								<li class="nav-item dropdown no-arrow">
									<b-dropdown variant="link" size="lg" toggle-class="text-decoration-none" no-caret right>
										<template slot="button-content">
											<i class="fas fa-bell"></i>
											<span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{alertasArray.length>0?alertasArray.length:''}}</span>
										</template>
										<table class="table table-hover" border="1" style="font-size: 9px;">
											<tr v-for="(item,idx) in alertasArray" :key="idx">
												<td v-if="idx<5">{{item.mensaje}}</td>
											</tr>
											<tr><td><center></center></td></tr>
										</table>
										<b-dropdown-item>
										</b-dropdown-item>
									</b-dropdown>
								</li>
							</ul>
						</nav>
						<!-- End of Topbar -->
						<!-- Begin Page Content -->
						<div class="container-fluid">
							<!-- Content Row -->
							<div class="row">
								<!-- Area Chart -->
								<div class="col-xl-12 col-lg-12">
									<div class="card shadow mb-4">
										<!-- Card Header - Dropdown -->
										<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
											<h6 class="m-0 font-weight-bold text-primary">{{title}}</h6>
										</div>
										<!-- Card Body -->
										<div class="card-body">
											<div class="container-fluid">
												<router-view></router-view>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<vue-snotify></vue-snotify>
						<!-- /.container-fluid -->
					</div>
					<!-- End of Main Content -->
					<!-- Footer -->
					<footer class="sticky-footer bg-white">
						<div class="container my-auto">
							<div class="copyright text-center my-auto">
								<span>Sistema de gestión de contratación.</span>
							</div>
						</div>
					</footer>
					<!-- End of Footer -->
				</div>
				<!-- End of Content Wrapper -->
			</div>
			<!-- End of Page Wrapper -->
			<!-- Scroll to Top Button-->
			<a class="scroll-to-top rounded" href="#page-top">
			<i class="fas fa-angle-up"></i>
			</a>
		</template>
		<router-view v-else/>

	</div>
</template>
<script>
export default
{
	data()
	{
		return {
			audio:Object,
			title: '',
			user:Object,
			base:'',
			menu:{superior:true,lateral:false},
			alertasArray:[],
			dashboard:false,
		}
  	},
	watch:{
		'$route' (to, from)
		{
			let me = this;
			me.title=to.meta.title;
		},
		'name'(value)
		{
			console.log({name:value})
		}
    },
	methods: {
		
		searchActualizaciones()
		{
			let me = this;
			let url =base+'/showAlerts';
			axios
			.get(url)
			.then(function(response)
			{
				me.alertasArray = response.data.data;
			})
		},
		salir()
		{
			localStorage.removeItem('permisos');
			let url = base+'/logout';
			window.location=url;

		},
		verAlerta(data)
		{
			let me = this;
			try {
				data.forEach((value)=>{
					me.$snotify.info(value.mensaje);
   					me.audio.play()
				})
			} catch (error) {
				console.warn(error);
			}
		},
		onlyId(data)
		{
			let res=[];
			data.forEach((value)=>{res.push(value.id)});
			return res;
		},
		comparar()
		{
			let me = this;
			let url =base+'/showAlerts';
			axios
			.get(url)
			.then(function(response)
			{
				let newAlert=[];
				let news=me.onlyId(response.data.data);
				let olds=me.onlyId(me.alertasArray)
				news.forEach((value,idx)=>{
					if(!olds.includes(value))
					{
						newAlert.push(response.data.data[idx])
					}
				})
				if(newAlert.length>0)
				{
					me.alertasArray=response.data.data;
					me.verAlerta(newAlert);
				}
			})
			.catch((response)=>{
				console.warn(response);
			})
		},
	},
	mounted()
	{
		if(this.$route.name=='responseencuesta')
		{
			this.dashboard=false;
		}
		else{
			
			let me = this;
			let file_path = base+'/sound/notify.mp3';
			me.audio = new Audio(file_path);
			me.menu.lateral=false;
			me.base = base;
			me.title=me.$route.meta.title;
			this.dashboard=true;
		}
	}
}
</script>
