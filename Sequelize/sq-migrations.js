to create model and migration
id, createdAt, updatedAdd - by default will be included, no need to setting
name - single value
sequelize model:generate --name Admin --attributes name:string,email:string,password:string
sequelize model:generate --name Category --attributes name:string,status:enum
sequelize model:generate --name Option --attributes option_name:string,option_value:string
sequelize model:generate --name User --attributes name:string,email:string,mobile:string,gender:enum,address:text,status:enum
sequelize model:generate --name Setting --attributes total_days:integer,status:enum
sequelize model:generate --name Book --attributes name:string,categoryId:integer,description:text,amount:integer,cover_image:string,author:string,status:enum
sequelize model:generate --name IssueBbook --attributes categoryId:integer,bookId:integer,userId:integer,day_issued:integer,issue_date:date,is_returned:enum,returned_date:date,status:enum

## issue book
module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.createTable("IssueBbooks", {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      categoryId: {
        type: Sequelize.INTEGER,
        references: {
          model: {
            tableName: "Categories" // to get category name, go  to migration file.
          },
          key: "id"
        },
        allowNull: false
      },
      bookId: {
        type: Sequelize.INTEGER,
        references: {
          model: {
            tableName: "Books" // to get category name, go  to migration file.
          },
          key: "id"
        },
        allowNull: false
      },
      userId: {
        type: Sequelize.INTEGER,
        references: {
          model: {
            tableName: "Users" // to get category name, go  to migration file.
          },
          key: "id"
        },
        allowNull: false
      },
      day_issued: {
        type: Sequelize.INTEGER(11),
        allowNull: false
      },
      issue_date: {
        type: Sequelize.DATE,
        defaultValue: Sequelize.literal("CURRENT_TIMESTAMP")
      },
      is_returned: {
        type: Sequelize.ENUM("1", "0"),
        defaultValue: "0"
      },
      returned_date: {
        type: Sequelize.DATE,
        allowNull: true
      },
      status: {
        type: Sequelize.ENUM("1", "0"),
        defaultValue: "1"
      },
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE,
        defaultValue: Sequelize.literal("CURRENT_TIMESTAMP")
      },
      updatedAt: {
        allowNull: false,
        type: Sequelize.DATE,
        defaultValue: Sequelize.literal("CURRENT_TIMESTAMP")
      }
    });
  },
  down: async (queryInterface, Sequelize) => {
    await queryInterface.dropTable("IssueBbooks");
  }
};

#issue model

const { Model } = require("sequelize");
module.exports = (sequelize, DataTypes) => {
  class IssueBbook extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      // define association here
    }
  }
  IssueBbook.init(
    {
      categoryId: DataTypes.INTEGER,
      bookId: DataTypes.INTEGER,
      userId: DataTypes.INTEGER,
      day_issued: DataTypes.INTEGER,
      issue_date: DataTypes.DATE,
      is_returned: DataTypes.ENUM("1", "0"),
      returned_date: DataTypes.DATE,
      status: DataTypes.ENUM("1", "0")
    },
    {
      sequelize,
      modelName: "IssueBbook"
    }
  );
  return IssueBbook;
};


###category
module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.createTable('Categories', {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      name: {
        type: Sequelize.STRING(50),
        allowNull: false
      },
      status: {
        type: Sequelize.ENUM('1', '0'),
        defaultValue: '1'
      },
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE,
        defaultValue: Sequelize.literal("CURRENT_TIMESTAMP")
      },
      updatedAt: {
        allowNull: false,
        type: Sequelize.DATE,
        defaultValue: Sequelize.literal("CURRENT_TIMESTAMP")
      }
    });
  },
  down: async (queryInterface, Sequelize) => {
    await queryInterface.dropTable('Categories');
  }
};

## category model
const {
  Model
} = require('sequelize');
module.exports = (sequelize, DataTypes) => {
  class Category extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      // define association here
    }
  }
  
  Category.init({
    name: DataTypes.STRING,
    status: DataTypes.ENUM('1', '0')
  }, {
    sequelize,
    modelName: 'Category',
  });
  return Category;
};

After migrations are filled need to setup config.js
1. create database
2. type 

npx sequelize db:migrate

If have an error in terminal, need to fix migration and run comand again, it will create just broken migration.

