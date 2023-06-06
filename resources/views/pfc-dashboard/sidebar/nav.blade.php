
 
<div id="sidebar" class="sidebar"> 
   <div data-scrollbar="true" data-height="100%"> 
      <ul class="nav">
         <li class="nav-profile">
            <a href="javascript:;" data-toggle="nav-profile">
               <div class="cover with-shadow"></div> 
                  <div class="image">
                     <img src="{{ asset('img/admin.png') }}" alt="" /> 
                  </div>  
               <div class="info">
                  {{ auth()->user()->name }}
                  <small>{{ auth()->user()->role->name }}</small>
               </div>
            </a>
         </li>
      </ul> 
      <ul class="nav">
         <li class="nav-header">Navigation</li>
         <li class="has-sub {{ Request::is('home') ? 'active' : '' }}">
            <a href="/home">
               <div class="icon-img">
                    <i class="fa fa-home"></i>
               </div>
               <span>Dashboard</span>
            </a>
         </li>
 

          
            

            <li class="has-sub {{ Request::is('projects') ? 'active' : '' }} {{ Request::is('pending-projects') ? 'active' : '' }} {{ Request::is('approved-projects') ? 'active' : '' }} {{ Request::is('cancelled-projects') ? 'active' : '' }} {{ Request::is('archived-projects') ? 'active' : '' }}" style="border-bottom: 1px solid #46505a; border-top: 1px solid #46505a;">
                  <a href="javascript:;">
                     <b class="caret"></b>
                     <div class="icon-img">
                           {{-- <img src="{{ asset('img/app.png') }}" alt="" class="round bg-inverse" /> --}}
                           <i class="fa fa-user-md"></i>
                     </div>
                     <span>Projects</span>
                  </a>
                  <ul class="sub-menu">
                     <li class="{{ Request::is('projects') ? 'active' : '' }}">
                           <a class="" href="/projects">
                              All Projects
                           </a>
                     </li>
                     <li class="{{ Request::is('pending-projects') ? 'active' : '' }}">
                           <a class="" href="/pending-projects">
                              Pending Projects
                           </a>
                     </li>
                     <li class="{{ Request::is('approved-projects') ? 'active' : '' }}">
                           <a class="" href="/approved-projects">
                              Approved Projects
                           </a>
                     </li>
                     <li class="{{ Request::is('cancelled-projects') ? 'active' : '' }}">
                           <a class="" href="/cancelled-projects">
                              Rejected Projects
                           </a>
                     </li>
                     <li class="{{ Request::is('archived-projects') ? 'active' : '' }}">
                           <a class="" href="/archived-projects">
                              Archived Projects
                           </a>
                     </li>
                  </ul>
               </li>
 


           

            <li class="has-sub {{ Request::is('events') ? 'active' : '' }} {{ Request::is('pending-events') ? 'active' : '' }}  {{ Request::is('rejected-events') ? 'active' : '' }}{{ Request::is('approved-events') ? 'active' : '' }} {{ Request::is('archived-events') ? 'active' : '' }}"  style="border-bottom: 1px solid #46505a;
            border-top: 1px solid #46505a;">
            <a href="javascript:;">
               <b class="caret"></b>
               <div class="icon-img">
               {{--    <img src="{{ asset('img/app.png') }}" alt="" class="round bg-inverse" /> --}}
               <i class="fa fa-list"></i>
               </div>
               <span>Events</span>
            </a>
            <ul class="sub-menu">
               <li class="{{ Request::is('events') ? 'active' : '' }}">  
                  <a class="" href="/events">
                        All Events
                  </a> 
               </li>   
               <li class="{{ Request::is('pending-events') ? 'active' : '' }}">  
                  <a class="" href="/pending-events">
                        Pending Events
                  </a> 
               </li>   
               <li class="{{ Request::is('approved-events') ? 'active' : '' }}">   
                  <a class="" href="/approved-events">
                        Approved Events
                  </a> 
               </li>  
               <li class="{{ Request::is('rejected-events') ? 'active' : '' }}">   
                  <a class="" href="/rejected-events">
                        Rejected Events
                  </a> 
               </li>
               <li class="{{ Request::is('archived-events') ? 'active' : '' }}">   
                  <a class="" href="/archived-events">
                        Archived Events
                  </a> 
               </li>
            </ul>
       
            <li class="has-sub {{ Request::is('donations') ? 'active' : '' }} {{ Request::is('archived-donations') ? 'active' : '' }}"  style="border-bottom: 1px solid #46505a;
            border-top: 1px solid #46505a;">
            <a href="javascript:;">
               <b class="caret"></b>
               <div class="icon-img">
               {{--    <img src="{{ asset('img/app.png') }}" alt="" class="round bg-inverse" /> --}}
               <i class="fa fa-money"></i>
               </div>
               <span>Donations</span>
            </a>
            <ul class="sub-menu">
               <li class="{{ Request::is('donations') ? 'active' : '' }}">  
                       
                        <a class="" href="/donations">
                                         Donation lists
                        </a> 
                    </a>   
                    <li class="{{ Request::is('archived-donations') ? 'active' : '' }}">  
                       
                       <a class="" href="/archived-donations">
                                        Archive lists 
                       </a> 
                   </a>   
                   
            </ul>   
            

        

           

            <li class="has-sub {{ Request::is('expenses') ? 'active' : '' }} {{ Request::is('archived-expenses') ? 'active' : '' }}"  style="border-bottom: 1px solid #46505a;
            border-top: 1px solid #46505a;">
            <a href="javascript:;">
               <b class="caret"></b>
               <div class="icon-img">
               {{--    <img src="{{ asset('img/app.png') }}" alt="" class="round bg-inverse" /> --}}
               <i class="fa fa-flag"></i>
               </div>
               <span>Expenses</span>
            </a>
            <ul class="sub-menu">
               <li class="{{ Request::is('expenses') ? 'active' : '' }}">  
               <a class="" href="http://church-monitoring-system.test/expenses?event_filter=All+Approved+Events">
                                     Expense lists
                         </a> 
                    </a>   
                    <li class="{{ Request::is('archived-expenses') ? 'active' : '' }}">  
                        <a class="" href="/archived-expenses">
                                     Archive lists
                         </a> 
                    </a>   
            </ul> 

            <li class="has-sub {{ Request::is('meetings') ? 'active' : '' }} {{ Request::is('archived-meetings') ? 'active' : '' }} {{ Request::is('approved-meetings') ? 'active' : '' }} {{ Request::is('rejected-meetings') ? 'active' : '' }}{{ Request::is('pending-meetings') ? 'active' : '' }} "  style="border-bottom: 1px solid #46505a;
            border-top: 1px solid #46505a;">
            <a href="javascript:;">
               <b class="caret"></b>
               <div class="icon-img">
               {{--    <img src="{{ asset('img/app.png') }}" alt="" class="round bg-inverse" /> --}}
               <i class="fa fa-flag"></i>
               </div>
               <span>Meetings</span>
            </a>
            <ul class="sub-menu">
               <li class="{{ Request::is('meetings') ? 'active' : '' }}">  
                        <a class="" href="/meetings">
                                     Meeting list
                         </a> 
                        <li class="{{ Request::is('pending-meetings') ? 'active' : '' }}">  
                        <a class="" href="/pending-meetings">
                                     Pending list
                         </a> 
                         <li class="{{ Request::is('approved-meetings') ? 'active' : '' }}">  
                        <a class="" href="/approved-meetings">
                                     Approved list
                         </a> 
                         <li class="{{ Request::is('rejected-meetings') ? 'active' : '' }}">  
                        <a class="" href="/rejected-meetings">
                                     Rejected list
                         </a> 
                         <li class="{{ Request::is('archived-meetings') ? 'active' : '' }}">  
                        <a class="" href="/archived-meetings">
                                     Archived list
                         </a> 
            </ul> 

            <li class="has-sub {{ Request::is('reports') ? 'active' : '' }} {{ Request::is('donation-reports') ? 'active' : '' }}"  style="border-bottom: 1px solid #46505a;
            border-top: 1px solid #46505a;">
            <a href="javascript:;">
               <b class="caret"></b>
               <div class="icon-img">
               {{--    <img src="{{ asset('img/app.png') }}" alt="" class="round bg-inverse" /> --}}
               <i class="fa fa-flag"></i>
               </div>
               <span>Reports</span>
            </a>
            <ul class="sub-menu">
               <li class="{{ Request::is('reports') ? 'active' : '' }}">  
                       <a class="" href="/reports">
                                         Expense lists
                        </a>
                                   
                    </a>      

                    <li class="{{ Request::is('donation-reports') ? 'active' : '' }}">  
                     <a class="" href="/donation-reports">
                                        Donation lists
                              </a> 
                                   
                    </a>   
            </ul>
         </li>
         <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="ion-ios-arrow-back"></i> <span>Collapse</span></a></li>
      </ul> 
   </div> 
</div>
<div class="sidebar-bg"></div>