<?php
                include('../CommonFiles/Connections.php');
                include('../CommonFiles/session.php');
                $op=$_GET['Option'];
                $Date=explode("-",$_GET['Date']);
                if($op==0){
                    $userssql="SELECT * FROM users ORDER BY Sort";
                }else if($op==1){
                    if(count($Date)!=2){
                        $userssql="SELECT * FROM `users` as TheUser WHERE (SELECT COUNT(*) FROM viewers WHERE UserID=TheUser.UserID)=(SELECT COUNT(*) FROM story) ORDER BY Sort";
                    }else{
                        $userssql="SELECT * FROM users as TheUser WHERE 
                        (SELECT COUNT(*) FROM viewers
                        INNER JOIN story ON viewers.StoryID=story.StoryID AND MONTH(story.Date)='".$Date[1]."' AND YEAR(story.Date)='".$Date[0]."'
                        WHERE UserID=TheUser.UserID)
                        =(SELECT COUNT(*) FROM story WHERE MONTH(Date)='".$Date[1]."'AND YEAR(Date)='".$Date[0]."') AND 
                        (SELECT COUNT(*) FROM story WHERE MONTH(Date)='".$Date[1]."'AND YEAR(Date)='".$Date[0]."')!=0
                        ORDER BY Sort";
                    }
                }else{
                    if(count($Date)!=2){
                        $userssql="SELECT * FROM `users` as TheUser WHERE (SELECT COUNT(*) FROM viewers WHERE UserID=TheUser.UserID)!=(SELECT COUNT(*) FROM story) ORDER BY (SELECT COUNT(*) FROM viewers WHERE UserID=TheUser.UserID) DESC,TheUser.sort ASC";
                    }else{
                        $userssql="SELECT * FROM users as TheUser WHERE 
                        (SELECT COUNT(*) FROM viewers
                        INNER JOIN story ON viewers.StoryID=story.StoryID AND MONTH(story.Date)='".$Date[1]."' AND YEAR(story.Date)='".$Date[0]."'
                        WHERE UserID=TheUser.UserID)
                        !=(SELECT COUNT(*) FROM story WHERE MONTH(Date)='".$Date[1]."'AND YEAR(Date)='".$Date[0]."') 
                        ORDER BY (SELECT COUNT(*) FROM viewers INNER JOIN story ON viewers.StoryID=story.StoryID AND MONTH(story.Date)='".$Date[1]."' AND YEAR(story.Date)='".$Date[0]."' WHERE UserID=TheUser.UserID) DESC,TheUser.sort ASC";
                    }
                }
                $usersda=$conn->query($userssql);
                if($usersda->num_rows>0){
                    $jur=1;
                    while($userdata=$usersda->fetch_assoc()){
                        $UserName=$userdata['UserName'];
                        $Links = explode('(', $UserName);
                        $Links= $Links[0];
                        ?>
                        <tr draggable="true" ondragstart="drag_start(event,0)" ondragover="drag_over(event,0)" ondragend="drag_drop(event,'<?php echo $userdata['UserID'];?>')">
                        <td id="OrderNum"><?php echo $userdata['Sort']; ?></td>
                        <?php
                            $new=($userdata['Status']==0)?"   <b class='newuser'>(NEW)</b>":"";
                            if(count($Date)!=2){
                                $count1=$conn->query("SELECT StoryID FROM viewers WHERE UserID='".$userdata['UserID']."'")->num_rows;
                                $count2=$conn->query("SELECT StoryID FROM story")->num_rows;
                            }else{
                                $count1=$conn->query("SELECT viewers.StoryID FROM viewers 
                                    INNER JOIN story ON story.StoryID=viewers.StoryID 
                                    WHERE viewers.UserID='".$userdata['UserID']."' AND MONTH(story.Date)='".$Date[1]."' AND YEAR(story.Date)='".$Date[0]."'")->num_rows;
                                $count2=$conn->query("SELECT StoryID FROM story 
                                    WHERE MONTH(Date)='".$Date[1]."' AND YEAR(Date)='".$Date[0]."'")->num_rows;
                            }
                            $stylecolor=($count1!=$count2)?"color:red;":"";
                        ?>
                        <td style='text-align:left;padding-right:25px;padding-left:10px;min-width:440px;'><a href='https://www.instagram.com/<?php echo $Links;?>' target='_blank'><?php echo $UserName.$new;?></a></td>
                        <td <?php echo "style='$stylecolor'"?>><?php echo "($count1/$count2)";?></td>
                        <td style='padding:5px 10px 5px 10px;'><a href="UserDetails.php?details=<?php echo $userdata['UserID'];?>" ><button type='button' class="View">View</button></a></td>
                        </tr>
                        <?php
                        $jur++;
                    }
                }else{
                    echo "<tr><td style='text-align:center;padding-right:25px;padding-left:10px;min-width:530px;' colspan='4'>NO Data</td></tr>";
                }
                ?>