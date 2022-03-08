import React from 'react';
import {Container,Row, Col, Button, Icon, Card, Select, TextInput} from 'react-materialize'
import Persons from "../../components/Persons/Persons";
import Comments from "../../components/Comments/Comments";
import Convex from "../../components/Convex/Convex";
import FormContainer from "../../components/FormContainer/FormContainer";





export const comments = [
    {id:0, login:'Vasya',avatar:'https://twizz.ru/wp-content/uploads/-000//1/12-32.jpg', date:'10.10.2021', text:"Равным образом сложившаяся структура организации играет важную роль в формировании направлений прогрессивного развития. Разнообразный и богатый опыт новая модель организационной деятельности требуют от нас анализа системы обучения кадров, соответствует насущным потребностям." },
    {id:1, login:'Vasy2',avatar:'https://static.kulturologia.ru/files/u18214/portrait61.jpg', date:'10.10.2021', text:'Равным образом сложившаяся структура организации играет важную роль в формировании направлений прогрессивного развития.'},
    {id:2, login:'Vasy3',avatar:'https://i.pinimg.com/originals/37/96/88/379688670502e9edf28d261dd3c143d2.jpg', date:'10.10.2021', text:'На чили ан кайфи'},
    {id:3, login:'Vasy4 Fractal',avatar:'https://i.pinimg.com/originals/37/96/88/379688670502e9edf28d261dd3c143d2.jpg', date:'10.10.2021', text:'На чили ан кайфи'},
]


export const initialState = [
    {
        id:0,
        firstname:"Аркадий",
        surname:"Укурник",
        profession:"гениральный директор",
        avatar:'team/arcadiy.jpg',
        links:[ //TODO соц сети
            {
                text:"",
                url:"",
                icon:"",
            }
        ],
        description:"Создатель компании 'Extremly', эксперт в области отдыха и чила, кандидат наук по кайфологии и" +
            " релаксоведению. Автор книги 'Чилил, Чилю, Буду Чилить' и 'Тупа адыхаю'."

    },
    {
        id:1,
        firstname:"Виктор",
        surname:"Альбиносов",
        profession:"исполнительный директор",
        avatar: 'team/victor.jpeg',
        links:[ //TODO соц сети
            {
                text:"",
                url:"",
                icon:"",
            }
        ],
        description:"Тот самый парень, что делает 90 процентов и работы и за это мы благодарны ему. Именно он делает" +
            " возможной деятельность компании."

    },
    {
        id:2,
        firstname:"Виктория",
        surname:"Импалова",
        profession:"Маркетолог",
        avatar:'team/victoria.jpg',
        links:[ //TODO соц сети
            {
                text:"",
                url:"",
                icon:"",
            }
        ],
        description:"Вика наш козырь в рукаве. Ведь с её складом ума, а также социальными и бизнес-наывками " +
            "показатели компании растут как грибы."

    },
]

const SectionAbout = () => {
    return (
        <section style={{backgroundColor:"#222222", padding:"30px 0"}}>

            <Container>
                <Row style={{padding:"34px 25px", backgroundColor:'#101010', marginBottom:'60px'}}>
                    <Col className="m4 push white-text">
                        <h2>О нас</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum expedita mollitia sunt! Amet blanditiis cupiditate debitis deserunt distinctio dolor ducimus enim, excepturi explicabo harum, id, itaque maiores minus odit praesentium quae quaerat quasi qui saepe similique tempora ullam ut vero voluptatibus voluptatum?
                        </p>
                        <p style={{fontSize:'0.8em', color:"lightgray"}}>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis neque quasi repudiandae sunt tempora!
                        </p>
                        <Button
                            large
                            node="a"
                            style={{
                                marginRight: '5px',
                                backgroundColor:"#DE4564",
                                color:"white"
                            }}
                            waves="light"
                        >
                            Button
                            <Icon left>
                                cloud
                            </Icon>
                        </Button>
                    </Col>
                    <Col className="m4 push-m1">
                        <div style={{width:"600px", height:"400px",backgroundColor:"#DE4564"}}><img className="hoverable" style={{width:"100%",height:"100%",position:'relative',top:"20px", left:"20px"}} src="https://www.ski.ru/kohana/upload/ckfinder_images/u72923/images/72923_1401882273.JPEG" alt=""/></div>
                    </Col>
                </Row>
                <h3 className="white-text">Наши преимущества</h3>
                <Row>
                    <Col className="s5 large" style={{backgroundColor:'#f2733c',padding:0, margin:"50px 0"}}>
                        <Card style={{backgroundColor:"#111111", width:"100%", height:'100%', margin:0, position:'relative', top:20,left:20}}
                        title="Мы сотрудничаем напрямую с организаторами"
                        className="white-text">
                        <p style={{color: "#F2733C", marginLeft: '30px'}}>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque enim facere nemo quis? Alias, amet beatae blanditiis delectus dolor doloribus ea, eveniet fugit harum minus molestias numquam obcaecati, praesentium quasi quo sequi unde. Delectus distinctio dolores ipsa odio officiis quis?</p>
                        </Card>
                    </Col>
                    <Col className="s6 push-s1 small" style={{backgroundColor:'#DE4564',padding:0, margin:"30px 0"}}>
                        <Card style={{backgroundColor:"#111111", width:"100%", height:'100%', margin:0, position:'relative', top:20,left:20}}
                        title="Мы сотрудничаем напрямую с организаторами"
                        className="white-text">
                        <p style={{color: "#DE4564", marginLeft: '30px'}}>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque beatae deserunt eligendi ipsam ipsum libero nam nisi quae quaerat sed? Animi eveniet quam quisquam ratione!</p>
                        </Card>
                    </Col>
                    <Col className="s6 push-s1 small" style={{backgroundColor:'#43A17C',padding:0, margin:"30px 0"}}>
                        <Card style={{backgroundColor:"#111111", width:"100%", height:'100%', margin:0, position:'relative', top:20,left:20}}
                        title="Мы сотрудничаем напрямую с организаторами"
                        className="white-text">
                        <p style={{color: "#43A17C", marginLeft: '30px'}}>Lorem ipsum dolor sit.</p>
                        </Card>
                    </Col>
                </Row>
                <h3 className="white-text">Наша команда:</h3>
                <Persons persons={initialState}/>
                <Comments comments={comments}>
                    <>
                        <h2>Lorem ipsum.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At commodi consectetur consequatur corporis exercitationem hic incidunt, ipsam ipsum modi nam natus nemo non perspiciatis placeat quasi quos reiciendis sunt totam ut vel velit voluptatibus voluptatum! Autem delectus dicta explicabo omnis.</p>
                        <Button large>Вперед!</Button>
                    </>
                </Comments>
                <h3 className="white-text">Подписаться на рассылку:</h3>
                <Convex size={"large"} s={12} background={'linear-gradient(269.17deg, #DB4463 13.23%, #F2733C 88.24%)'}>
                    <FormContainer icon={<img style={{width:'100%'}} src="img/ui/letter.png" alt=""/>} background={'#111111'}>
                        <form action="">
                            <Row>

                                    <Select
                                        s={10}
                                        icon={<Icon className="little-icon">cloud</Icon>}
                                        id="Select-15"
                                        multiple={false}
                                        options={{
                                            classes: '',
                                            dropdownOptions: {
                                                alignment: 'left',
                                                autoTrigger: true,
                                                closeOnClick: true,
                                                constrainWidth: true,
                                                coverTrigger: true,
                                                hover: false,
                                                inDuration: 150,
                                                onCloseEnd: null,
                                                onCloseStart: null,
                                                onOpenEnd: null,
                                                onOpenStart: null,
                                                outDuration: 250
                                            }
                                        }}
                                        value=""
                                    >
                                        <option
                                            disabled
                                            value=""
                                        >
                                            Choose your option
                                        </option>
                                        <option value="1">
                                            Option 1
                                        </option>
                                        <option value="2">
                                            Option 2
                                        </option>
                                        <option value="3">
                                            Option 3
                                        </option>
                                    </Select>


                                    <TextInput
                                        s={10}

                                        icon={<Icon className="little-icon">email</Icon>}
                                        id="TextInput-34"
                                        label="Email"
                                    />
                                    <Row>
                                        <Col push={'s7'} s={3}>
                                            <Button style={{backgroundColor:"#DB4463"}} large>Подписаться</Button>
                                        </Col>
                                    </Row>
                            </Row>
                        </form>
                    </FormContainer>
                </Convex>
            </Container>
        </section>
    );
};

export default SectionAbout;