 <div class="deznav">
            <div class="deznav-scroll">
				<div class="main-profile">
					<div class="image-bx">
						<img src="{{ asset ('dash/images/kaneta.png') }}" alt="">
						{{-- <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a> --}}
					</div>
					<h5 class="name"><span class="font-w400">Hello,</span>{{auth()->user()->name}}</h5>
					<p class="email"><a href="" class="__cf_email__" data-cfemail="95f8f4e7e4e0f0efefefefd5f8f4fcf9bbf6faf8">{{auth()->user()->email}}</a></p>
				</div>
				
				<ul class="metismenu" id="menu">
					@if (auth()->user()->level=="guru"|| auth()->user()->level == "admin"|| auth()->user()->level == "siswa")
					<li class="nav-label first"></li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
							<i class="flaticon-144-layout"></i>
							<span class="nav-text" >Home</span>
						</a>
						<ul aria-expanded="false">
							<li><a href="/home">Dashboard</a></li>
							
						</ul>
                        <ul aria-expanded="false">
							<li><a href="/home">Petunjuk Pengunaan</a></li>
							
						</ul>

                    </li>
					@if(!$expired)
					 <li><a  href="/vote" aria-expanded="false">
							<i class="flaticon-077-menu-1"></i>
							<span class="nav-text">Vote</span>
						</a>
                       
                    </li>
					@endif
				@endif
				@if ( auth()->user()->level == "admin")
					<li class="nav-label first">Main Menu</li>
                    <li><a  href="/admin" aria-expanded="false">
							<i class="flaticon-044-file"></i>
							<span class="nav-text">Data Admin</span>
						</a>
                       
                    </li>
					  <li><a  href="/guruu" aria-expanded="false">
							<i class="flaticon-044-file"></i>
							<span class="nav-text">Data Guru</span>
						</a>
                       
                    </li>
					<li><a  href="/siswaa" aria-expanded="false">
							<i class="flaticon-044-file"></i>
							<span class="nav-text">Data Siswa</span>
						</a>
                       
                    </li>
					<li><a  href="/calonosis" aria-expanded="false">
							<i class="flaticon-044-file"></i>
							<span class="nav-text">Data Calon OSIS</span>
						</a>
                       
                    </li>
					<li><a  href="/datapoling" aria-expanded="false">
							<i class="flaticon-053-heart"></i>
							<span class="nav-text">Data Polling</span>
						</a>
                       
                    </li>
					<li><a  href="/datavoted" aria-expanded="false">
							<i class="flaticon-381-network"></i>
							<span class="nav-text">Data Voted</span>
						</a>
                       
                    </li>
					<li><a  href="/setting" aria-expanded="false">
							<i class="flaticon-381-settings-2"></i>
							<span class="nav-text">Setting Tanggal</span>
						</a>
                       
                    </li>
				@endif
                </ul>
				<div class="copyright">
					<p><strong>E-Vote </strong> © 2024 All Rights Reserved</p>
					<p class="fs-12">Made with <span class="heart"></span> by SYNC</p>
				</div>
			</div>
        </div>