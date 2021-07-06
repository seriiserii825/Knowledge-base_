#nuxt config
  axios: { proxy: true },
  proxy: { "/api/": process.env.BASE_URL + "/" },
  auth: {
    strategies: {
      local: {
        token: {
          property: "token",
          global: true
          // required: true,
          // type: 'Bearer'
        },
        user: {
          property: "user",
          autoFetch: false
        },
        endpoints: {
          login: { url: "/api/login", method: "post" },
          logout: { url: "/api/auth/logout", method: "post" },
          user: { url: "/api/auth/user", method: "get" }
        }
      }
    }
  },

#auth routes
const { Router } = require("express");
const router = Router();
const {
  login,
  register,
  user,
  logout
} = require("./../controllers/auth.controller");

router.post("/api/login", login);
router.post("/api/auth/register", register);
router.get("/api/auth/user", user);
router.post("/api/auth/logout", logout);

module.exports = router;

#auth controllers
const User = require("./../models").User;
const Sequelize = require("sequelize");
const Op = Sequelize.Op;
const bcrypt = require("bcrypt-nodejs");
const jwt = require("jsonwebtoken");

module.exports.login = async (req, res) => {
  const login = req.body.login;
  const password = req.body.password;

  try {
    const candidate = await User.findOne({
      where: {
        login: {
          [Op.eq]: login
        }
      }
    });
    if (candidate) {
      if (bcrypt.compareSync(password, candidate.password)) {
        const token = jwt.sign(
          {
            user: candidate.login,
            userId: candidate.id
          },
          process.env.JWT,
          { expiresIn: "2h" }
        );

        res
          .status(200)
          .json({ status: 1, message: "You are logged in", token });
      } else {
        res.status(200).json({ status: 0, message: "User not found" });
      }
    } else {
      res.status(200).json({ status: 0, message: "User not found" });
    }
  } catch (error) {
    throw error;
    return res.status(500).json(error);
  }
};

module.exports.register = async (req, res) => {
  const { login, password } = req.body.data;
  try {
    const candidate = await User.findOne({
      where: {
        login: {
          [Op.eq]: login
        }
      }
    });
    if (candidate) {
      res.status(200).json({ status: 0, message: "User exists" });
    } else {
      const salt = bcrypt.genSaltSync(10);
      await User.create({
        login: login,
        password: bcrypt.hashSync(password, salt)
      });
      res.status(200).json({ status: 1, message: "User was created" });
    }
  } catch (error) {
    throw error;
    return res.status(500).json(error);
  }
};

module.exports.user = async (req, res) => {
  const token = req.headers["authorization"];
  const newToken = token.replace("Bearer ", "");
  if (token) {
    jwt.verify(newToken, process.env.JWT, (error, decode) => {
      if (error) {
        res.status(403).json({ status: 0, message: "invalid token", error });
      } else {
        res.status(200).json({ status: 1, user: decode.user });
      }
    });
  } else {
    res.status(500).json({ status: 0, message: "Please, send a token" });
  }
};

module.exports.logout = (req, res) => {
  res.status(200).json({ status: 1, message: "You are logged in", token: "" });
};

#logout method
  methods: {
    logout() {
      this.$auth.logout();
    }
  }

#login
    submitForm() {
      this.loading = true;
      this.$refs.ruleForm.validate(async valid => {
        if (valid) {
          try {
            const data = {
              login: this.ruleForm.login,
              password: this.ruleForm.password
            };
            const response = await this.$auth.loginWith("local", {
              data: this.ruleForm
            });

            this.loading = false;

            if (response.data.status === 1) {
              this.$message.success(response.data.message);
              window.location.href = process.env.baseUrl;
            } else {
              this.$message.warning(response.data.message);
            }
          } catch (error) {
            this.loading = false;
          }
        } else {
          this.loading = false;
          console.log("error submit!!");
          return false;
        }
      });
    }
