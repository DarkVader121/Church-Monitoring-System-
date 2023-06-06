@auth
   <!-- begin #page-container -->
   <div id="page-container" >
      <!-- begin #header -->
      <div id="header" class="header navbar-inverse" style="background: #2580ff;">
         <!-- begin navbar-header -->
         <div class="navbar-header">
            <a href="/home" class="navbar-brand"><span></span> {{-- <img src="{{ asset('img/dhvsu.png') }}"> --}} &nbsp; 


               <b>Lila Holy Rosary Parish Event Monitoring System</b> &nbsp;  

            </a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
            </button>
         </div>
         <!-- end navbar-header -->
         <!-- begin header-nav -->
         <ul class="navbar-nav navbar-right">
            <li class="dropdown navbar-user">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                
                   <img src="{{ asset('img/admin.png') }}" alt="" /> 
                     <span class="d-none d-md-inline">{{ auth()->user()->username }}</span> 
               </a>
               <div class="dropdown-menu dropdown-menu-right">
                  
                  <a href="/settings" class="dropdown-item">Profile</a>
                  <a href="/change-password" class="dropdown-item">Change Password</a>
                  <a href="/update-phone" class="dropdown-item">Update Contact</a>
                  <div class="dropdown-divider"></div>
                    <a href="/logout" onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();" class="dropdown-item">
                            Logout
                        </a>
                        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
               </div>
            </li>
         </ul>
         <!-- end header-nav -->
      </div>
      <!-- end #header -->
      

@endauth