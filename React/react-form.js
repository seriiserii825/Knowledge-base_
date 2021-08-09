import React from 'react';

class Form extends React.Component {
    state = {
        firstName: '',
        email: '',
        message: '',
        select: '',
        subscription: false,
        gender: ''
    }

    handleChange = (e) => {
        this.setState({[e.target.name]: e.target.value})
    }
    handleCheckboxChange = (e) => {
        this.setState({[e.target.name]: e.target.checked})
    }

    emailValidation = (email) => {
        const re = /^(([^<>()[\]\\.,;:\s@]+(\.[^<>()[\]\\.,;:\s@]+)*)|(.+))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    validateEmail = () => {
        return this.emailValidation(this.state.email)
    }

    validateName = () => {
        return this.state.firstName.length < 3;
    }

    render() {
        const {firstName, email, message, select, subscription, gender} = this.state;
        const firstNameError = this.state.firstName.length < 3 ? 'error active' : 'error';
        const emailError = !this.validateEmail() ? 'error active' : 'error';
        return (
            <div>
                <div className="form-group">
                    <input type="text" onChange={this.handleChange} name="firstName" placeholder="firstName"
                           onBlur={this.validateName}
                           value={firstName}/>
                    <p className={firstNameError}>Field length less 3</p>
                </div>
                <div className="form-group">
                    <input type="text" onChange={this.handleChange} name="email" placeholder="email"
                           onBlur={this.validateEmail}
                           value={email}/>
                    <p className={emailError}>Field need to be an email!!!</p>
                </div>
                <div className="form-group">
                    <textarea onChange={this.handleChange} name="message" id="message" value={message}>some</textarea>

                </div>
                <div className="form-group">
                    <p>
                        <select name="select" id="select" value={select} onChange={this.handleChange}>
                            <option value="" disabled="disabled">Choose an option</option>
                            <option value="1">select value 1</option>
                            <option value="2">select value 2</option>
                            <option value="3">select value 3</option>
                        </select>
                    </p>

                </div>
                <div className="form-group">
                    <p>
                        <label>
                            <span>Subscription: </span>
                            <input type="checkbox" name="subscription" checked={subscription}
                                   onChange={this.handleCheckboxChange}/>
                        </label>
                    </p>
                </div>
                <div className="form-group">
                    <p>
                        <label>
                            <span>Male: </span>
                            <input type="radio" name="gender" value="male"
                                   checked={gender === "male"}
                                   onChange={this.handleChange}/>
                        </label>
                    </p>
                    <p>
                        <label>
                            <span>Female: </span>
                            <input type="radio" name="gender" value="female"
                                   checked={gender === "female"}
                                   onChange={this.handleChange}/>
                        </label>
                    </p>
                </div>
            </div>
        )
    }
}

export {Form};
