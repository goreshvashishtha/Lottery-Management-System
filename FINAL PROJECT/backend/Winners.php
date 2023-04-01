<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
}
?>








<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
    <link rel="stylesheet" href="AU Dashboard.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

<!------ Java Script Section      -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
       <script>

        async function connect(){
           account= await window.ethereum.request({method:"eth_requestAccounts"}).catch((err)=>{
                 console.log(err.code)
             })
            console.log(account);
        }
    </script>

<script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.22/dist/web3.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
       
        <script>
            var contract;
            var web3;
            $(document).ready(function(){
               web3=new Web3(window.web3.currentProvider);
               var address="0x81ba7E49eE2736fc18F4CDF6105Ae0CeDB080eF1";
               var abi=[
               {
                   "inputs": [],
                   "stateMutability": "nonpayable",
                   "type": "constructor"
               },
               {
                   "inputs": [],
                   "name": "getBalance",
                   "outputs": [
                       {
                           "internalType": "uint256",
                           "name": "",
                           "type": "uint256"
                       }
                   ],
                   "stateMutability": "view",
                   "type": "function"
               },
               {
                   "inputs": [],
                   "name": "manager",
                   "outputs": [
                       {
                           "internalType": "address",
                           "name": "",
                           "type": "address"
                       }
                   ],
                   "stateMutability": "view",
                   "type": "function"
               },
               {
                   "inputs": [],
                   "name": "pickWinner",
                   "outputs": [],
                   "stateMutability": "nonpayable",
                   "type": "function"
               },
               {
                   "inputs": [
                       {
                           "internalType": "uint256",
                           "name": "",
                           "type": "uint256"
                       }
                   ],
                   "name": "players",
                   "outputs": [
                       {
                           "internalType": "address payable",
                           "name": "",
                           "type": "address"
                       }
                   ],
                   "stateMutability": "view",
                   "type": "function"
               },
               {
                   "stateMutability": "payable",
                   "type": "receive"
               }
           ];
            
           contract = new web3.eth.Contract(abi, address); 
             contract.methods.getBalance().call().then(function(ownr){
                $('#symbol').html(ownr);
               })
            })

            $('#initialize').click(function(accounts){
               // var collection;
               //collection=$('#collection_id').val();
                //var token_id=0;
                //token_id=$('#token_id').val();
                
               // var amount=0;
                //amount=parseInt($('#amount').val());
                
                web3.eth.getAccounts().then(function(accounts){
                    var acc=accounts[0];
                    return contract.methods.getBalance().send({from:acc});
                }).then(function(tx){
                    console.log(tx);
                }).catch(function(tx){
                    console.log(tx);
                })
            });


            $('#redeem_btn').click(function(accounts){
 
                var amount=0;
                amount=$('#redeem_num').val();
                
                web3.eth.getAccounts().then(function(accounts){
                    var acc=accounts[0];
                    return contract.methods.redeem(amount).send({from:acc});
                }).then(function(tx){
                    console.log(tx);
                }).catch(function(tx){
                    console.log(tx);
                })
            }); 

            
        </script>



<!------------- HTML Section ------>





<div class="sidebar">
    <div class="logo-details">
      <i class=''></i>
      <span class="logo_name">DeLottery</span>
    </div>
      <ul class="nav-links">
        <li>
          <a href="Admin Dashboard.php" class="">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Check Winner</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bx-cog' ></i>
            <span class="links_name">Settings</span>
          </a>
        </li>
        <li class="log_out">
          <a href= "logout.php ">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>




  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      
        
      <button type="button" class="con-btn" onclick="connect()">Connect MetaMask Account</button>
        
      
      <div class="profile-details">
        <h1>Welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
      </div>
    </nav>

    <div class="home-content">
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total User</div>
            <div class="number">8</div>
          </div> 
        </div>


        <div class="box">
          <div class="right-side">
            <div class="box-topic">New User</div>
            <div class="number">3</div>
          </div>
        </div>
        <div class="box">


          <div class="right-side">
            <div class="box-topic">Total Events</div>
            <div class="number"> 15 </div>
          </div>
        </div>

        
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Highest Price</div>
            <div class="number">13.5 Lakh</div>
          </div>
        </div>
      </div>




      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title">Events</div>
          <div class="sales-details">
            <ul class="details">
              <li class="topic">ID</li>
              <li><a href="#">12</a></li>
              <li><a href="#">13</a></li>
              <li><a href="#">14</a></li>
            </ul>

            <ul class="details">
            <li class="topic">Customer</li>
            <li><a href="#">Goresh Vashishtha</a></li>
            <li><a href="#">Shivam Chaurasia</a></li>
            <li><a href="#">Akash Sharma</a></li>
          </ul>

          <ul class="details">
            <li class="topic">Status</li>
            <li><a href="#">Active</a></li>
            <li><a href="#">Active</a></li>
            <li><a href="#">Active</a></li>
          </ul>

          <ul class="details">
            <li class="topic">User-Type</li>
            <li><a href="#">Admin</a></li>
            <li><a href="#">User</a></li>
            <li><a href="#">User</a></li>
          </ul>
          </div>
          <div class="button">
            <a href="#">See All</a>
          </div>
        </div>
        <div class="top-sales box">
          <div class="title">Top 5 Winners</div>
          <ul class="top-sales-details">
            <li>
            <a href="#">
              <!--<img src="images/sunglasses.jpg" alt="">-->
              <span class="product">Navneet Mishra</span>
            </a>
            <span class="price">10 ETH</span>
          </li>
          <li>
            <a href="#">
               <!--<img src="images/jeans.jpg" alt="">-->
              <span class="product">Chirag Jain </span>
            </a>
            <span class="price">8 ETH</span>
          </li>
          <li>
            <a href="#">
             <!-- <img src="images/nike.jpg" alt="">-->
              <span class="product">Prateek Sahu</span>
            </a>
            <span class="price">7 ETH</span>
          </li>
          <li>
            <a href="#">
              <!--<img src="images/scarves.jpg" alt="">-->
              <span class="product">Amit Sharma</span>
            </a>
            <span class="price">5 ETH</span>
          </li>
          <li>
            <a href="#">
              <!--<img src="images/blueBag.jpg" alt="">-->
              <span class="product">Karan Shirpurkar</span>
            </a>
            <span class="price">3 ETH</span>
          </li>
          
          </ul>
        </div>
      </div>
    </div>
  </section>

  <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>

</body>
</html>

