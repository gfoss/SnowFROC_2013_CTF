Shadowcorp::Application.routes.draw do
  resources :posts do
    collection do
      post :search
    end
  end
end
