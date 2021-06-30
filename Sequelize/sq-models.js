Admins id, name, email, password, createAt, updateAt - (id, createdAt, updatedAt will be created by default)
Admins - table
Admin - single in query 
Fields: string, eunm(select), text, integer

# Создаем 2 файла с миграцией и моеделью
npx sequelize model:generate --name IssueBook --attributes categoryId:integer,bookId:integer,userId:integer,days_issued:integer,issued_date:date,is_returned:enum,returned_date:date,status:enum

# После правки миграции вызываем ее
npx sequelize db:migrate
В базе данных создастя новая таблица

add current time stamp
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE,
        defaultValue: Sequelize.literal("CURRENT_TIMESTAMP")
      },

remove timestamp
in migration need to coment
      // createdAt: {
      //   allowNull: false,
      //   type: Sequelize.DATE,
      //   defaultValue: Sequelize.literal("CURRENT_TIMESTAMP")
      // },
      // updatedAt: {
      //   allowNull: false,
      //   type: Sequelize.DATE,
      //   defaultValue: Sequelize.literal("CURRENT_TIMESTAMP")
      // }
in model to add timestamp: false
  Product.init({
    name: DataTypes.STRING,
    description: DataTypes.TEXT,
    amount: DataTypes.INTEGER
  }, {
    sequelize,
    modelName: 'Product',
    timestamps: false
  });

### Set default param
setDefaultValueFor Enum in migration
status: {
        type: Sequelize.ENUM('1', '0'),
        defaultValue: '1'
},

also we need to do this and in the model 
status: DataTypes.ENUM('1', '0')


### Create reference 
      categoryId: {
        type: Sequelize.INTEGER,
        references: {
          model: {
            tableName: "Categories"
          },
          key: 'id'
        }
      },

Table name we can find in migration
    await queryInterface.createTable('Categories', {
      id: {
        allowNull: false,
        autoIncrement: true,

After will finish to set all migrations, need to type:
npx sequelize db:migrate
