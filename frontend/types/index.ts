declare global{

  interface Loginform{
    email: string;
    password: string;
  }

  interface User{
    id: number;
    name: string;
    email: string;
   
  }

  interface Registerform{
    name: string;
    email: string;
    password: string;

  }

  interface validationErrors{
  [key: string]: string[];
  }

  interface profileForm{
    name: string;
    email: string;
   
  }

  interface Product {
    id?: number;
    title: string;
    description: string;
    price: number;
    category: string;
    image: string;
    rating: {
      rate: number;
      count: number;
    };
  }
  
   interface Content {
    id?: number;
    page: string;
    content: string;
    background_color: string;
    phone?:number;
    email?:string;
    address?:string;
    text_color: string;
    image: string;
    created_at?: string;
    updated_at?: string;

  }


}