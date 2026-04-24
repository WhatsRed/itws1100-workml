Github: WhatsRed  
Repo name: itws1100-workml  
Site: [workmlrpi.eastus.cloudapp.azure.com/iit](http://workmlrpi.eastus.cloudapp.azure.com/iit)  
Discord: WhatsRed

Guestbook:

Features  
\- Users can submit messages  
\- Messages stored in MySQL  
\- Display newest first  
\- AJAX submission (no reload)  
\- Character counter  
\- XSS protection

Table:

CREATE TABLE guestbook (  
  id INT AUTO\_INCREMENT PRIMARY KEY,  
  name VARCHAR(100) NOT NULL,  
  comment TEXT NOT NULL,  
  created\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP  
);

IA:

quiz3/  
│  
├── guestbook.php   
├── config.php  
├── prompt-log.md  
├── README.md   
├── break-it.md 