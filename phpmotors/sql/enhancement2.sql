Insert Into clients (clientFirstname, clientLastname, clientEmail, clientPassword, comment)
Values ('Tony', 'Stark', 'Tony@starkent.com', 'Iam1ronm@n', 'I am the real Ironman');
Update clients Set clientlevel = '3';
Update inventory Set invDescription = replace(invDescription, 'small interior', 'spacious interior') Where invMake = 'GM' And invModel = 'Hummer';
Select inventory.invModel, carclassification.classificationName
from inventory Inner Join carclassification
On inventory.classificationId=carclassification.classificationId
Where carclassification.classificationName = 'SUV';
Delete From inventory Where inventory.invMake = 'Jeep' And inventory.invModel = 'Wrangler';
Update inventory Set invImage = concat ("/phpmotors", invImage), invThumbnail = concat("/phpmotors", invThumbnail);