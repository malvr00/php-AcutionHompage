# PHP Auction Server is Apache & OS is CentOS
중고물품 또는 새로운 물품들 경매하는 경매장 사이트.
포인트를 활용하여 물품 경매참여.

## DB Table
<pre> 
유저 Table                                                    유저 상세 Table
<img src="https://user-images.githubusercontent.com/77275513/129029968-f3418e80-7fbf-432e-8113-d094c30615a5.PNG" width="350px" height="230px" title="100px" alt="RubberDuck"></img>               <img src="https://user-images.githubusercontent.com/77275513/128179866-f616c458-801f-4ac8-9be9-cdc79423f5b3.PNG" width="350px" height="230px" title="100px" alt="RubberDuck"></img><br/> 
경매물품 Table                                                경매물품 현황 Table
<img src="https://user-images.githubusercontent.com/77275513/133568631-b1d82c31-bc59-474c-8094-2ef456f5ae4b.PNG" width="350px" height="230px" title="100px" alt="RubberDuck"></img>               <img src="https://user-images.githubusercontent.com/77275513/128179699-2b9d4d88-3d8d-4bf7-a8d2-c72838a1fcf9.PNG" width="350px" height="230px" title="100px" alt="RubberDuck"></img><br/> 
카테고리 Table1                                               카테고리 Table2
<img src="https://user-images.githubusercontent.com/77275513/128180178-8f32ae0c-ecf6-4551-8cc4-9fb52ea3f871.PNG" width="350px" height="230px" title="100px" alt="RubberDuck"></img>               <img src="https://user-images.githubusercontent.com/77275513/128180262-97c85286-310f-4fb0-957b-a875a5501096.PNG" width="350px" height="230px" title="100px" alt="RubberDuck"></img><br/> 
게시판 Table                                                  댓글 Table
<img src="https://user-images.githubusercontent.com/77275513/128180023-0b3beca6-69d1-4e2c-889a-8eb3dc6bce46.PNG" width="350px" height="230px" title="100px" alt="RubberDuck"></img>               <img src="https://user-images.githubusercontent.com/77275513/128180112-35a8215e-3d52-4429-91df-56f3192cb451.PNG" width="350px" height="230px" title="100px" alt="RubberDuck"></img><br/> 
</pre>

## Pages && Includes
> 로그인 유저 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/includes/userInformation.php)

* Main page [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/php/index.php)
1. 물품출력

* LogIn . Out & SignIn Page [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/userInOut.php)
1. 로그인  [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/userInOut.php#L62-L89)
2. 회원가입 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/userInOut.php#L16-L61)
3. 로그아웃 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/userInOut.php#L92-L93)
4. 회원탈퇴 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/userSecession.php)
5. 유저 상세정보 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/userInOut.php#L90-L91)

* User  [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/userdetail.php)
1. 포인트 충전 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/charging.php)
2. 등록한 물품 수 확인 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/enrollment.php#L73-L86) / 물품 등록할 때 카운트
3. 낙찰 받은 수 확인 [[코드1]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/auctionEnd.php#L53-L63) [[코드2]]

* User bulletin board page 
> 게시글 수정 및 삭제는 게시글 등록자만 볼 수 있도록 설정 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/writingView.php#L16-L17)
1. 게시판 등록 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/writingUpload.php)
2. 등록된 게시글 보기 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/writing.php)
3. 게시글 상세보기 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/writingView.php)
4. 게시글 삭제 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/writingDelete.php)
5. 게시글 수정 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/writingModify.php)
6. 댓글 등록 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/writingComment.php)

* Items [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/auctiondetail.php)
1. 물품 등록 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/enrollment.php)
3. 물품 입찰 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/auctiondetail.php#L48-L87)
4. 물품 즉매 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/auctiondetail.php#L88-L149)
5. 물품 낙찰 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/auctionEnd.php)
6. 물품 삭제 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/auctionDelete.php)
7. 등록한 전체 물품보기 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/articleItems.php)

* Category [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/controllers/categoryMenu.php)
1. 카테고리 분류 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/includes/Userfunction.php#L23-L34)
2. 카테고리 별 물품 표시 [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/js/dispaly.js)

* Form File [[위치]](https://github.com/malvr00/php-AcutionHompage/tree/main/templates)
* SQL Class [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/includes/Userfunction.php)
* Db Connect [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/includes/DbConnect.php)
* CSS [[위치]](https://github.com/malvr00/php-AcutionHompage/tree/main/css)
> main css [[코드]](https://github.com/malvr00/php-AcutionHompage/blob/main/css/style.css)
