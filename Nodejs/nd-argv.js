node backend/seeder -d  destroy data
node backend/seeder  import data

if(process.argv[2] === '-d'){
  destroyData();
}else{
  importData();
}

package.json 
"data:import": "node backend/seeder"
"data:destroy": "node backend/seeder"
